<?php
session_start();
$page='funcionarios';
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
<span class="destaque">Alteração Funcionário</span><br>
<div class="ui breadcrumb" style="margin-top: 0px">
  <div class="section"><i class="home icon"></i> Home</div>
  <div class="divider"> / </div>
  <div class="ativado section">Alteração Funcionário</div>
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

<?php
$id=$_GET['id'];
$sql2= "SELECT * FROM usuario WHERE id=$id";
$result2= mysql_query($sql2, $link);

if (!$result2) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$row2 = mysql_fetch_assoc($result2);
mysql_free_result($result2); 

$area2=$row2['area'];
$sql3= "SELECT * FROM area WHERE id=$area";
$result3= mysql_query($sql3, $link);

if (!$result3) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$row3 = mysql_fetch_assoc($result3);
mysql_free_result($result3); 
?>

<div class="ui divider"></div>

<div class="ui grid">
  <div class="eight wide column">
  <div class="ui segment">
  <div class="ui grid">
  <div class="eight wide column">
  <b>Nome: </b><?php echo $row2['nome']; ?><br><br>
  <b>E-mail: </b><?php echo $row2['email']; ?><br><br>
  <b>Matricula: </b><?php echo $row2['matricula']; ?>
  </div>
  
  <div class="eight wide column">
  <b>Área: </b><?php echo $row3['nome']; ?><br><br>
  <b>Turno: </b><?php echo $row3['turno']; ?>
  </div>
  </div>
  </div>
  </div>
  
  <div class="eight wide column">
  <div class="ui grid">
  <div class="eight wide column">
  <form action="salvar-dia.php" method="post">
  <b>Dias para troca:</b><br>
  <div class="ui input fluid">
  <input type="text" id="dia" name="dia" value="<?php echo $row2['diatroca']; ?>">
  <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
  </div>
  <br>
  <button class="ui orange tiny button" type="submit">Alterar dias</button>
  </form>
  </div>
  
  <div class="eight wide column">
  <form action="salvar-senha.php" method="post">
  <b>Alterar Senha:</b><br>
  <div class="ui input fluid">
  <input type="password" id="senha" name="senha" required>
  <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
  </div>
  <br>
  <button class="ui blue tiny button" type="submit">Salvar</button>
  </form>
  </div>
  
  </div>
  </div>
</div>

<br><br><br>
    <div class="ui divider"></div>
    
  <span class="destaque2">Movimentação do funcionário</span><br>
  <br>
  <?php 
  	$sqlfunc= "SELECT * FROM movimentacao_usuario WHERE id_usuario=$id";
	$resultfunc= mysql_query($sqlfunc, $link);

	if (!$resultfunc) {
		echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
		echo 'Erro MySQL: ' . mysql_error();
		exit;
	}
	
	$numrows= mysql_num_rows($resultfunc);
	
	if ($numrows<=0) {
  ?>
  	Não existe movimentação anterior...
  <?php 	
	} else {
		?>
        <div class="ui grid">
        <?php
		while ($rowfunc = mysql_fetch_assoc($resultfunc)) {
  ?>

  
   <div class="eight wide column">
   <div class="ui segment">
   <span class="destaque3">#<?php echo $rowfunc['id']; ?></span><br><br>
   <span style="float: left"><b>Data da alteração:</b> <?php echo date("d/m/Y", strtotime($rowfunc['data'])); ?> </span>
   <span style="float: right"><b>Tipo de Alteração:</b> <?php echo $rowfunc['alteracao']; ?> </span><br><br>
   <?php 
   	$idsup=$rowfunc['id_supervisor'];
   	$sql4= "SELECT * FROM usuario WHERE id=$idsup";
	$result4= mysql_query($sql4, $link);
	
	if (!$result4) {
		echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
		echo 'Erro MySQL: ' . mysql_error();
		exit;
	}

	$row4 = mysql_fetch_assoc($result4);
	mysql_free_result($result4); 
   ?>
   <span style="float: left"><b>Alterado por:</b> <?php echo $row4['nome']; ?></span> 
   <span style="float: right"><b>Funcionário:</b> <?php echo $row2['nome']; ?> </span>
   </div>
   </div>
  
  
  <?php 
		}
		
		?>
        </div>
        
  <?php
  }
  mysql_free_result($resultfunc); 
  ?>


</div>

</div>

<script type="text/javascript">
$('select.dropdown')
  .dropdown()
;
</script>

</body>

</html>