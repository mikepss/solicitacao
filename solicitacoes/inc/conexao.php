<?php 
if (!$link = mysql_connect('localhost', 'root', '')) {
    echo 'Não foi possível conectar ao mysql';
    exit;
}

if (!mysql_select_db('solicitacoes', $link)) {
    echo 'Não foi possível selecionar o banco de dados';
    exit;
}
header('Content-Type: text/html; charset=utf-8');
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

?>