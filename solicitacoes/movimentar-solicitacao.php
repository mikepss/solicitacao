<?php
session_start();
include("inc/conexao.php");

$id=$_POST['id'];
$observacao=$_POST['observacao'];
$aprovacao=$_POST['status'];

$sql= "UPDATE solicitacao SET aprovacao=$aprovacao, observacao='$observacao' WHERE id=$id";
$result= mysql_query($sql, $link);

if ($result) {
	header("location: ferias.php");
}
else
{
    echo "Erro do banco de dados, não foi possível inserir no banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}
?>