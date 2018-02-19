<?php
session_start();
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
	$id=$_GET['id'];
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
<?php
$sql2= "SELECT * FROM solicitacao WHERE id=$id";
$result2= mysql_query($sql2, $link);

if (!$result2) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$row2 = mysql_fetch_assoc($result2);
mysql_free_result($result2); 
?>
<div class="conteudocomp">
<div class="headercomp">
<div class="esq">
<span class="destaque">Solicitação #<?php echo $row2['id']; ?></span><br>
<div class="ui breadcrumb" style="margin-top: 0px">
  <div class="section"><i class="home icon"></i> Home</div>
  <div class="divider"> / </div>
  <div class="ativado section">Solicitação #<?php echo $row2['id']; ?></div>
</div>
</div>

<div class="dir">

</div>
</div>

<div class="ui divider"></div>

<div class="ui grid">
  <div class="eight wide column">
<b>Solicitação</b><br>
<div class="ui icon input">
        <input type="text" name="solicitacao" id="solicitacao" value="<?php echo $row2['id']; ?>" disabled>
        <i class="sign in icon"></i>
      </div>
      <br><br>


<b>Tipo:</b> <?php 
	  if($row2['tipo']==1) 
	  {
		  $page="ferias";
		  echo "Solicitação de Férias";
		  } 
		  else if($row2['tipo']==2) 
		  {
			  $page="dias";
			  echo "Solicitação de Dia";
		  } ?>
<br><br>
<?php 
$id_usu=$row2['id_usuario'];
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
<b>Solicitante:</b> <?php echo $rowu['nome']; ?><br><br>
<b>Observação</b><br><br>
    <div class="ui form">
    <textarea style="resize:none" name="observacao" required disabled><?php echo $row2['observacao']; ?></textarea>
    </div>
  </div>

  <div class="eight wide column">
    <div class="ui three column grid">
    <div class="column">
    <b>Abertura</b><br>

    <?php echo date("d/m/Y H:i", strtotime($row2['data_solicitada'])); ?>    </div>

    <div class="column">
    <b>Data de Inicio</b><br>
    <?php echo date("d/m/Y", strtotime($row2['data_inicio'])); ?>
  </div>
    <div class="column">
    <b>Supervisor Responsável</b><br>
    Nome do Supervisor</div>
    </div>
<br>
    <b>Status</b><br><br>
    <select class="dropba" name="status" style="margin-top:-5px;color:#0845C0" disabled>
              <option value="<?php echo $row2['aprovacao']; ?>">
			  <?php if($row2['aprovacao']==0) {echo "Aberto";} else
			  if($row2['aprovacao']==1) {echo "Em Andamento";} else
			  if($row2['aprovacao']==2) {echo "Aprovado";} else
			  if($row2['aprovacao']==3) {echo "Recusado";} ?>
              </option>
              <option value="1" style="color:#555">Em Andamento</option>
              <option value="2" style="color:#555">Aprovado</option>
              <option value="3" style="color:#555">Recusado</option>
            </select>
            
  </div>
  </div>






</div>

</div>

<script type="text/javascript">
$('select.dropdown')
  .dropdown()
;
</script>

</body>

</html>