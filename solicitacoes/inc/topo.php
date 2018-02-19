<div class="topo">
<div class="topesq">
<?php echo $mensagem ?>
</div>

<div class="topdir">
<?php
$area=$_SESSION['area'];
$sql= "SELECT * FROM area WHERE id=$area";
$result= mysql_query($sql, $link);

if (!$result) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$row = mysql_fetch_assoc($result);
mysql_free_result($result); 
?>

<div class="infos">
<span class="destnome"><?php echo $_SESSION['nome']; ?></span><br>
<span class="destdep"><?php echo $row['nome']; ?></span>
</div>

<div class="infos">
<a href="logout.php"><button class="ui icon button yellow mini" style="margin-top: 5px;background-color: #FF7900"><i class="power icon"></i></button></a>
</div>

</div>
</div>

