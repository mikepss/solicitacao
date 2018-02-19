<nav class="menu2">
<div class="logo">
<a href="home.php"><img src="images/logotipo.png" width="200"></a>
</div>

<ul class="links">
<li class="<?php if($page=='home') {echo 'active';} ?>" onclick="location.href='home.php';"><i class="home icon"></i> Página principal</li>

<li class="<?php if($page=='ferias') {echo 'active';} ?>" onclick="location.href='ferias.php';"><i class="calendar icon"></i> Solicitação de férias</li>

<li class="<?php if($page=='dias') {echo 'active';} ?>" onclick="location.href='dias.php';"><i class="browser icon"></i> Solicitação de dia</li>

<?php 
if ($_SESSION['nivel']>=2) {
?>
<li class="<?php if($page=='funcionarios') {echo 'active';} ?>" onclick="location.href='funcionarios.php';"><i class="user icon"></i> Funcionários</li>
<li class="<?php if($page=='solicitacoes') {echo 'active';} ?>" onclick="location.href='solicitacoes.php';"><i class="send icon"></i> Últimas solicitações</li>
<?php
}
?>
</ul>

<div class="copyright">
<center>
<img src="images/unicamp.png" width="50"><br><br>
2016 © Unicamp.<br> Todos os direitos reservados.
</center>
</div>
</nav>
