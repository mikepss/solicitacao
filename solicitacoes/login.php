<?php
ob_start();
session_start();
include("inc/conexao.php");

$matricula=$_POST['matricula'];
$senha=md5($_POST['senha']);

if (($matricula=="") || ($senha=="")) {
	unset ($_SESSION['matricula']);
	unset ($_SESSION['senha']);
	header("location: index.php");
} else {

$sql= "SELECT * FROM usuario WHERE matricula=$matricula";
$result= mysql_query($sql, $link);

if (!$result) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$row = mysql_fetch_assoc($result);
mysql_free_result($result); 

if (($row['senha']==$senha) && ($row['matricula']==$matricula)) {
	$_SESSION['matricula'] = $matricula;
	$_SESSION['senha'] = $senha;
	$_SESSION['nome']=$row['nome'];
	$_SESSION['area']=$row['area'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['emailsup'] = $row['emailsup'];
	$_SESSION['id'] = $row['id'];
	$_SESSION['nivel'] = $row['nivel'];
	$_SESSION['logado'] = "s";
	$_SESSION['diaferias'] = $row['diaferias'];
	$_SESSION['diatroca'] = $row['diatroca'];
	


$area=$_SESSION['area'];
$sql2= "SELECT * FROM area WHERE id=$area";
$result2= mysql_query($sql2, $link);

if (!$result2) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$row2 = mysql_fetch_assoc($result2);
mysql_free_result($result2); 

$_SESSION['turno']=$row2['turno'];

	header("location: home.php");
} else {
	unset ($_SESSION['matricula']);
	unset ($_SESSION['senha']);
	header("location: index.php");
}
}
?>