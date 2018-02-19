<html>
<head>
<title>Unicastelo - Sistema de Chamados</title>
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

</head>
<body id="sink" style="overflow: hidden">

<div style="width: 90%; margin: 0 auto; margin-top: 10%">
<div class="ui middle aligned center aligned grid">
  <div class="column">
      <a href="index.php"><img src="images/logo.png"></a><br><br>
      <div class="content">
      	<span class="chm"><b>CENTRAL DE SOLICITAÇÕES</b></span>
      </div><br>
    <form class="ui large form" action="recuperar.php" method="post">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="mail icon"></i>
            <input type="text" name="email" placeholder="Endereço de Email" required>
          </div>
        </div>
        <button type="submit" class="ui fluid large submit button" style="background-color: #FF7900;color: #fff">Recuperar Senha</button>
      </div>


    </form>
  </div>
</div>
</div>

</body>

</html>