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
<span class="destaque">Funcionários</span><br>
<div class="ui breadcrumb" style="margin-top: 0px">
  <div class="section"><i class="home icon"></i> Home</div>
  <div class="divider"> / </div>
  <div class="ativado section">Funcionários</div>
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

<table class="ui orange table">
  <thead>
    <tr><th>Matricula</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Área</th>
    <th>Turno</th>
  </tr></thead><tbody>
  <?php
$area=$_SESSION['area'];
$sqlfunc= "SELECT * FROM usuario WHERE area=$area Order by nome ASC";
$resultfunc= mysql_query($sqlfunc, $link);

if (!$resultfunc) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

while ($rowfunc = mysql_fetch_assoc($resultfunc)) {
?>
<?php
$areaf=$rowfunc['area'];;
$sqlf= "SELECT * FROM area WHERE id=$area";
$resultf= mysql_query($sqlf, $link);

if (!$resultf) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$rowf = mysql_fetch_assoc($resultf);
mysql_free_result($resultf); 


?>
    <tr onclick="location.href='perfil.php?id=<?php echo $rowfunc['id']; ?>'" style="cursor: pointer">
      <td><?php echo $rowfunc['matricula']; ?></td>
      <td><?php echo $rowfunc['nome']; ?></td>
      <td><?php echo $rowfunc['email']; ?></td>
      <td><?php echo $rowf['nome']; ?></td>
      <td><?php echo $rowf['turno']; ?></td>
    </tr>
<?php 
	}
mysql_free_result($resultfunc); 
?>
  </tbody>
</table>

</div>

</div>

<script type="text/javascript">
$('select.dropdown')
  .dropdown()
;
</script>

</body>

</html>