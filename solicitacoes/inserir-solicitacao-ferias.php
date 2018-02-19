<?php
session_start();
include("inc/conexao.php");

date_default_timezone_set('America/Sao_Paulo');

function converteData($data){
    return (preg_match('/\//',$data)) ? implode('-', array_reverse(explode('/', $data))) : implode('/', array_reverse(explode('-', $data)));
}

$data_solicitada=date('Y-m-d H:i');
$data_inicio=converteData($_POST['calendario']);
$dias=$_POST['dias'];
$pecunia=$_POST['pecunia'];
$decimo=$_POST['decimo'];
$id_usuario=$_SESSION['id'];
$aprovacao=0;
$turno=$_SESSION['turno'];

$sql= "INSERT INTO solicitacao (data_solicitada,data_inicio,dias,pecunia,decimo,id_usuario,aprovacao,tipo,turno) 
VALUES ('$data_solicitada','$data_inicio',$dias,$pecunia,$decimo,$id_usuario,$aprovacao,1,'$turno')";
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