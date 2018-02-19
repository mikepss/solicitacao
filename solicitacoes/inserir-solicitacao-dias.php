<?php
session_start();
include("inc/conexao.php");

date_default_timezone_set('America/Sao_Paulo');

function converteData($data){
    return (preg_match('/\//',$data)) ? implode('-', array_reverse(explode('/', $data))) : implode('/', array_reverse(explode('-', $data)));
}

$data_solicitada=date('Y-m-d H:i');
$inicio=strtotime(converteData($_POST['calendario']));
$fim=strtotime(converteData($_POST['calendario2']));
$dias=abs(($inicio-$fim)/86400); 
$data_inicio=converteData($_POST['calendario']);
$data_final=converteData($_POST['calendario2']);
$motivo=$_POST['motivo'];
$ausencia=$_POST['ausencia'];
$id_usuario=$_SESSION['id'];
$aprovacao=0;
$turno=$_SESSION['turno'];
$observacao=$_POST['observacao'];

$sql= "INSERT INTO solicitacao (data_solicitada,data_inicio,data_final,motivo,ausencia,id_usuario,aprovacao,tipo,turno,observacaousuario,dias) 
VALUES ('$data_solicitada','$data_inicio','$data_final',$motivo,$ausencia,$id_usuario,$aprovacao,2,'$turno','$observacao',$dias)";
$result= mysql_query($sql, $link);

if ($result) {
	header("location: dias.php");
}
else
{
    echo "Erro do banco de dados, não foi possível inserir no banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}
?>