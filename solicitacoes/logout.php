<?php
session_start();

unset ($_SESSION['cpf']);
unset ($_SESSION['senha']);
unset ($_SESSION['logado']);

header("location: index.php");
?>