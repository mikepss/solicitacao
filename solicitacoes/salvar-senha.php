<?php
session_start();

include("inc/conexao.php");

$senha=md5($_POST['senha']);
$id=$_POST['id'];
$idsupervisor=$_SESSION['id'];
$data=date("Y-m-d");
$alteracao="Alterar senha";

$sql= "SELECT * FROM usuario WHERE id=$id";
$result= mysql_query($sql, $link);

if (!$result) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$row = mysql_fetch_assoc($result);
mysql_free_result($result); 

$sql2 = "UPDATE usuario SET senha='$senha'";
$result2 = mysql_query($sql2, $link);

if (!$result2) {
    echo "Erro do banco de dados, não foi possível alterar a senha deste funcionário.\n";
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