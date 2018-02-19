<html>
<head>
<title>Vox - Unicamp</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="dist/semantic.css">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.address/1.6/jquery.address.min.js"></script>
  <script src="dist/semantic.min.js"></script>
  <style type="text/css">
    body {
      background-color: #DADADA;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>

<script>
function focar() {
	document.getElementById("matricula").focus();	
}
</script>
</head>
<body id="sink" style="overflow: hidden" onload="focar()">

<div style="width: 90%; margin: 0 auto; margin-top: 10%">
<div class="ui middle aligned center aligned grid">
  <div class="column">
      <img src="images/logo.png"><br><br>
      <div class="content">
      	<span class="chm"><b>CENTRAL DE SOLICITAÇÕES</b></span>
      </div><br>
    <form class="ui large form" action="login.php" method="post">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="matricula" id="matricula" placeholder="Matrícula" required>
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="senha" placeholder="Senha" required>
          </div>
        </div>
        <button type="submit" class="ui fluid large submit button" style="background-color: #FF7900;color: #fff">Acessar conta</button>
      </div>


    </form>

    <div class="ui message">
      Esqueceu a senha? <a href="recuperar-senha.php">clique aqui.</a>
    </div>
  </div>
</div>
</div>

</body>

</html>