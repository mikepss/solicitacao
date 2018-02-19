<?php
include("inc/conexao.php");

$email=$_POST['email'];

$sql= "SELECT * FROM usuario WHERE email='$email'";
$result= mysql_query($sql, $link);

if (!$result) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
} else {

$nome=$row['nome'];
$senha=$row['senha'];

$quebra_linha="\n";
$assunto="Recuperação de Dados";
$mensagem1="Olá $nome\n sua senha recuperada é: $senha";

if(!mail($email, $assunto, $mensagem1, $headers ,"-r".$email)){ // Se for Postfix
    $headers .= "Return-Path: " . $email . $quebra_linha; // Se "não for Postfix"
    mail($email, $assunto, $mensagem1, $headers );
}

header("location: recuperar-senha.php");
}

$row = mysql_fetch_assoc($result);
mysql_free_result($result); 

?>