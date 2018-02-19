<?php
session_start();
$page='solicitacoes';
include("inc/conexao.php");

if ($_SESSION['matricula'] && $_SESSION['senha']){

} else {
  header("location: logout.php");
}

    $data = date('D');
    $mes = date('M');
    $dia = date('d');
    $ano = date('Y');
    
    $mes_extenso = array(
        'Jan' => 'janeiro',
        'Feb' => 'fevereiro',
        'Mar' => 'marco',
        'Apr' => 'abril',
        'May' => 'maio',
        'Jun' => 'junho',
        'Jul' => 'julho',
        'Aug' => 'agosto',
        'Nov' => 'novembro',
        'Sep' => 'setembro',
        'Oct' => 'outubro',
        'Dec' => 'dezembro'
    );
    
    $mensagem= "{$dia} de " . $mes_extenso["$mes"] . " de {$ano} ";

?>

<html>
<head>
<title>Vox - Unicamp</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="dist/semantic.css">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.address/1.6/jquery.address.min.js"></script>
  <script src="dist/semantic.min.js"></script>

</head>
<body id="sink" onload="abrir()">
<?php include("inc/menu.php"); ?>

<div class="conteudo">



<?php include("inc/topo.php");?>
<div class="conteudocomp">
<div class="headercomp">
<div class="esq">
<span class="destaque">Últimas Solicitações</span><br>
<div class="ui breadcrumb" style="margin-top: 0px">
  <div class="section"><i class="home icon"></i> Home</div>
  <div class="divider"> / </div>
  <div class="ativado section">Últimas Solicitações</div>
</div>
</div>

<div class="dir">
<a class="ui blue image label">
  Dias p/trocar:
  <div class="detail"><?php echo $_SESSION['diatroca']; ?> dias</div>
</a>

<a class="ui orange image label">
  Dias p/ ferias:
  <div class="detail"><?php echo $_SESSION['diaferias']; ?> dias</div>
</a>
</div>
</div>

<div class="ui divider"></div>

<?php
$turno=$_SESSION['turno'];
$sqlf= "SELECT * FROM solicitacao WHERE turno='$turno' and aprovacao=0";
$resultf= mysql_query($sqlf, $link);

if (!$resultf) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$aberto=mysql_num_rows($resultf);

?>

<?php
$sqla= "SELECT * FROM solicitacao WHERE turno='$turno' and aprovacao=1";
$resulta= mysql_query($sqla, $link);

if (!$resulta) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$andamento=mysql_num_rows($resulta);

?>

<?php
$sqlc= "SELECT * FROM solicitacao WHERE turno='$turno' and aprovacao=2 or turno='$turno' and aprovacao=3";
$resultc= mysql_query($sqlc, $link);

if (!$resultc) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$concluido=mysql_num_rows($resultc);

?>

<div class="ui top attached tabular menu">
  <a class="item active" data-tab="first">Em Aberto (<?php echo $aberto; ?>)</a>
  <a class="item" data-tab="second">Em Andamento (<?php echo $andamento; ?>)</a>
  <a class="item" data-tab="third">Concluido (<?php echo $concluido; ?>)</a>
</div>
<div class="ui bottom attached tab segment active" data-tab="first">
  <table class="ui fixed table">
  <thead>
    <tr><th>ID</th>
    <th>Tipo</th>
    <th>Funcionário</th>
    <th>Data Solicitada</th>
  </tr></thead>
  <tbody>
	<?php 
    while($rowf = mysql_fetch_assoc($resultf)) {
$id_usu=$rowf['id_usuario'];
$sqlu= "SELECT * FROM usuario WHERE id=$id_usu";
$resultu= mysql_query($sqlu, $link);

if (!$resultu) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}
$rowu = mysql_fetch_assoc($resultu);
mysql_free_result($resultu);
    ?>
    <tr onclick="location.href='exibir-solicitacao.php?id=<?php echo $rowf['id'] ?>'" style="cursor: pointer">
      <td><b><span style="color:#FF7900">#<?php echo $rowf['id'] ?></span></b></td>
      <td><?php 
	  if($rowf['tipo']==1) 
	  {
		  echo "Solicitação de Férias";
		  } 
		  else if($rowf['tipo']==2) 
		  {
			  echo "Solicitação de Dia";
		  } ?></td>
      <td><?php echo $rowu['nome'] ?></td>
      <td><?php echo date("d/m/Y", strtotime($rowf['data_solicitada'])); ?></td>
    </tr>
    <?php
  	} 
	mysql_free_result($resultf); 
  	?>
    
  </tbody>
</table>
</div>



<div class="ui bottom attached tab segment" data-tab="second">
<table class="ui fixed table">
  <thead>
    <tr><th>ID</th>
    <th>Tipo</th>
    <th>Funcionário</th>
    <th>Data Solicitada</th>
  </tr></thead>
  <tbody>
	<?php 
    while($rowa = mysql_fetch_assoc($resulta)) {
$id_usu=$rowa['id_usuario'];
$sqlu= "SELECT * FROM usuario WHERE id=$id_usu";
$resultu= mysql_query($sqlu, $link);

if (!$resultu) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}
$rowu = mysql_fetch_assoc($resultu);
mysql_free_result($resultu);
    ?>
    <tr onclick="location.href='exibir-solicitacao.php?id=1'" style="cursor: pointer">
      <td><b><span style="color:#FF7900">#<?php echo $rowa['id'] ?></span></b></td>
      <td><?php 
	  if($rowa['tipo']==1) 
	  {
		  echo "Solicitação de Férias";
		  } 
		  else if($rowa['tipo']==2) 
		  {
			  echo "Solicitação de Dia";
		  } ?></td>
      <td><?php echo $rowu['nome'] ?></td>
      <td><?php echo date("d/m/Y", strtotime($rowa['data_solicitada'])); ?></td>
    </tr>
    <?php
  	} 
	mysql_free_result($resulta); 
  	?>
    
  </tbody>
</table>
  
</div>

<div class="ui bottom attached tab segment" data-tab="third">
  <table class="ui fixed table">
  <thead>
    <tr><th>ID</th>
    <th>Tipo</th>
    <th>Funcionário</th>
    <th>Data Solicitada</th>
  </tr></thead>
  <tbody>
	<?php 
    while($rowc = mysql_fetch_assoc($resultc)) {
$id_usu=$rowc['id_usuario'];
$sqlu= "SELECT * FROM usuario WHERE id=$id_usu";
$resultu= mysql_query($sqlu, $link);

if (!$resultu) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}
$rowu = mysql_fetch_assoc($resultu);
mysql_free_result($resultu);
    ?>
    <tr onclick="location.href='exibir-solicitacao.php?id=1'" style="cursor: pointer">
      <td><b><span style="color:#FF7900">#<?php echo $rowc['id'] ?></span></b></td>
      <td><?php 
	  if($rowc['tipo']==1) 
	  {
		  echo "Solicitação de Férias";
		  } 
		  else if($rowc['tipo']==2) 
		  {
			  echo "Solicitação de Dia";
		  } ?></td>
      <td><?php echo $rowu['nome'] ?></td>
      <td><?php echo date("d/m/Y", strtotime($rowc['data_solicitada'])); ?></td>
    </tr>
    <?php
  	} 
	mysql_free_result($resultc); 
  	?>
    
  </tbody>
</table>
</div>

</div>

</div>

<script type="text/javascript">
$('select.dropdown')
  .dropdown()
;

$('.menu .item')
  .tab()
;
</script>

</body>

</html>