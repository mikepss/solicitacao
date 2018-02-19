<?php
session_start();

include("inc/conexao.php");

$idsupervisor=$_SESSION['id'];
$dias=$_POST['dia'];
$id=$_POST['id'];
$data=date("Y-m-d");
$alteracao="Dias para troca";

$sql= "SELECT * FROM usuario WHERE id=$id";
$result= mysql_query($sql, $link);

if (!$result) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$row = mysql_fetch_assoc($result);
mysql_free_result($result); 

$diasfinal = $dias;

$sql2 = "UPDATE usuario SET diatroca=$diasfinal";
$result2 = mysql_query($sql2, $link);

if (!$result2) {
    echo "Erro do banco de dados, não foi possível alterar os dias deste funcionário.\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$sql3 = "INSERT INTO movimentacao_usuario(data,alteracao,id_supervisor,id_usuario) VALUES ('$data','$alteracao',$idsupervisor,$id)";
$result3 = mysql_query($sql3, $link);

if (!$result3) {
    echo "Erro do banco de dados, não foi possível alterar os dias deste funcionário.\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

header("location: perfil.php?id=$id");
?>