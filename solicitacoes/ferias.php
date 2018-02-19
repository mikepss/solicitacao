<?php
session_start();
$page="ferias";
include("inc/conexao.php");

if ($_SESSION['matricula'] && $_SESSION['senha']){

} else {
  header("location: logout.php");
}

    $data = date('D');
    $mes = date('M');
    $dia = date('d');
    $ano = date('Y');
    
    $mes_extenso = array(
        'Jan' => 'janeiro',
        'Feb' => 'fevereiro',
        'Mar' => 'marco',
        'Apr' => 'abril',
        'May' => 'maio',
        'Jun' => 'junho',
        'Jul' => 'julho',
        'Aug' => 'agosto',
        'Nov' => 'novembro',
        'Sep' => 'setembro',
        'Oct' => 'outubro',
        'Dec' => 'dezembro'
    );
    
    $mensagem= "{$dia} de " . $mes_extenso["$mes"] . " de {$ano} ";
date_default_timezone_set('America/Sao_Paulo');
$dataf = date('Y-m-d');
?>

<html>
<head>
<title>Vox - Unicamp</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="dist/semantic.css">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.address/1.6/jquery.address.min.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

  <script src="dist/semantic.min.js"></script>

<script language='JavaScript'>
function SomenteNumero(e){
 var tecla=(window.event)?event.keyCode:e.which;
 if((tecla>47 && tecla<58)) return true;
 else{
 if (tecla==8 || tecla==0) return true;
 else  return false;
 }
}
</script>
</head>
<body id="sink" onload="abrir()">
<?php include("inc/menu.php"); ?>

<div class="conteudo">



<?php include("inc/topo.php");?>
<div class="conteudocomp">
<div class="headercomp">
<div class="esq">
<span class="destaque">Solicitação de Férias</span><br>
<div class="ui breadcrumb" style="margin-top: 0px">
  <div class="section"><i class="home icon"></i> Home</div>
  <div class="divider"> / </div>
  <div class="ativado section">Solicitação de Férias</div>
</div>
</div>

<div class="dir">
<a class="ui blue image label">
  Dias p/trocar:
  <div class="detail"><?php echo $_SESSION['diatroca']; ?> dias</div>
</a>

<a class="ui orange image label">
  Dias p/ ferias:
  <div class="detail"><?php echo $_SESSION['diaferias']; ?> dias</div>
</a>
</div>
</div>

<div class="ui divider"></div>
<div class="ui grid">
  <div class="eight wide column">
   <div class="ui segment">
	<form action="inserir-solicitacao-ferias.php" method="POST">
    <div class="ui grid">
  	<div class="eight wide column">
    <b>A partir de:</b><br>
    <div class="ui input fluid">
    <input type="text" id="calendario" name="calendario" value="<?php echo date("d/m/Y", strtotime($dataf)); ?>" style="width: 70%; margin-right:5%">
    </div>
    </div>

    
    <div class="eight wide column">
    <b>Quantidade de dias</b><br>
    <div class="ui input fluid">
    <input type="text" id="dias" name="dias" onkeypress="return SomenteNumero(event);" required>
    </div>
	</div>
    </div>
    <br><br>
    
    <div class="ui grid">
    <div class="five wide column">
 	<b>Pecúnia:</b><br>
    <div class="field">
      <div class="ui radio checkbox">
    <input type="radio" name="pecunia" tabindex="0" class="hidden" value="1" required> <label>Sim</label> 
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <div class="ui radio checkbox">
    <input type="radio" name="pecunia" tabindex="0" class="hidden" value="0"required>  <label>Não</label> 
    </div>
    </div>
    </div>
    
    <div class="five wide column">
 	<b>13º Salário:</b><br>
    <div class="field">
      <div class="ui radio checkbox">
    <input type="radio" name="decimo" tabindex="0" class="hidden" value="1" required> <label>Sim</label>  
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="ui radio checkbox">
  	<input type="radio" name="decimo" tabindex="0" class="hidden" value="0" required> <label>Não</label> 
    </div>
    </div> 
    </div>
    
    <div class="six wide column">
    <button class="ui orange button" style="float: right;">Solicitar Férias</button>
    </div>
    </div>
    
    </form>
    </div>
  </div>
  
  <?php
$supervisor=$row['supervisor'];
$sql2= "SELECT * FROM usuario WHERE id=$supervisor";
$result2= mysql_query($sql2, $link);

if (!$result2) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

$row2 = mysql_fetch_assoc($result2);
mysql_free_result($result2); 
?>
  
  <div class="eight wide column">
  <b>Data de abertura:</b> <?php echo date("d/m/Y", strtotime($dataf)); ?><br><br>
  <b>Supervisor responsável:</b> <?php echo $row2['nome']; ?>
  </div>

</div>
	<br><br><br>
    <div class="ui divider"></div>
    
  <span class="destaque2">Histórico de férias</span><br>
  <br>
  <?php 
  $id=$_SESSION['id'];
  	$sqlferias= "SELECT * FROM solicitacao WHERE id_usuario=$id and tipo=1 ORDER By id Desc";
	$resultferias= mysql_query($sqlferias, $link);

	if (!$resultferias) {
		echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
		echo 'Erro MySQL: ' . mysql_error();
		exit;
	}
	
	$numrows= mysql_num_rows($resultferias);
	
	if ($numrows<=0) {
  ?>
  	Não existe pedidos de férias anteriores...
  <?php 	
	} else {
		?>
        <div class="ui grid">
        <?php
		while ($rowferias = mysql_fetch_assoc($resultferias)) {
  ?>

  
   <div class="eight wide column">
   <div class="ui segment" onclick="location.href='exibir-solicitacao-usuario.php?id=<?php echo $rowferias['id']; ?>'" style="cursor:pointer">
   <span class="destaque3">#<?php echo $rowferias['id']; ?></span>
   <div style="margin-top:-25px;">
   <a class="ui <?php if($rowferias['aprovacao']==0) { echo "grey"; } 
   else if($rowferias['aprovacao']==1) { echo "orange"; } 
   else if($rowferias['aprovacao']==2) { echo "blue"; }
   else if($rowferias['aprovacao']==3) { echo "red"; } ?> right ribbon label">
   <?php if($rowferias['aprovacao']==0) { echo "Aberto"; } 
   else if($rowferias['aprovacao']==1) { echo "Em Andamento"; } 
   else if($rowferias['aprovacao']==2) { echo "Aprovado"; }
   else if($rowferias['aprovacao']==3) { echo "Recusado"; } ?>
   </a>
   </div>
   <br>
   <span style="float: left"><b>Data do pedido:</b> <?php echo date("d/m/Y", strtotime($rowferias['data_solicitada'])); ?> </span>
   <span style="float: right"><b>Início das Férias:</b> <?php echo date("d/m/Y", strtotime($rowferias['data_inicio'])); ?> </span><br><br>
   
   <span style="float: left"><b>Dias de Férias:</b> <?php echo $rowferias['dias']; ?>  dias</span> 
   <span style="float: right"><b>Pecúnia:</b> <?php if($rowferias['pecunia']==1) { echo "Sim"; } else { echo "Não"; } ?> </span><br><br>
   
   <span style="float: left"><b>13º:</b> <?php if($rowferias['decimo']==1) { echo "Sim"; } else { echo "Não"; } ?></span> 
   </div>
   </div>
   
  
  
  <?php 
		}
		
		?>
        </div>
        
  <?php
  }
  mysql_free_result($resultferias); 
  ?>
</div>

</div>

<script type="text/javascript">
$('select.dropdown')
  .dropdown()
;

$('.ui.radio.checkbox')
  .checkbox()
;
</script>

<script>
$(function() {
    $("#calendario").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        showOn: "button",
        buttonImage: "calendario.png",
        buttonImageOnly: true
    });
});
</script>
</body>

</html>