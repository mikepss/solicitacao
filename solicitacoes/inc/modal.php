<div id="modal" class="hide">
    <div class="modal-bg"></div>
    <div class="modal-content">
      <div class="topmodal">
        <h5><i class="lightning icon"></i> Solicitação Rápida</h5>
        <a class="modal-close">&#215;</a>
      </div>
<form action="inserir-solicitacao.php" method="POST" enctype="multipart/form-data">
      <div class="contmodal">
        <button type="submit" class="ui blue button" style="float:right;border-radius: 6px">Enviar Solicitação</button><br><br>
        <div class="ui">
        <label><b>Área:</b></label><br>
            <select class="dropba" name="area" required>
              <option value="">Selecione a Área</option>
              <?php 
$sql4= "SELECT * FROM area order by id ASC";
$result4= mysql_query($sql4, $link);

if (!$result4) {
    echo "Erro do banco de dados, não foi possível consultar o banco de dados\n";
    echo 'Erro MySQL: ' . mysql_error();
    exit;
}

while ($row4 = mysql_fetch_assoc($result4)) {
?>
              <option value="<?php echo $row4['area'] ?>"><?php echo $row4['area'] ?></option>
              <?php 
}
mysql_free_result($result4); 
?>

            </select>
        </div>
        <br>
        <div class="ui">
        <label><b>Tipo:</b></label><br>
            <select class="dropba" name="tipo" required>
              <option value="">Selecione o Tipo</option>
              <option value="Incidentes">Incidentes</option>
              <option value="Solicitações">Solicitações</option>
              <option value="Melhorias">Melhorias</option>
              <option value="Problemas">Problemas</option>
            </select>
        </div>
        <br>
        <div class="ui">
        <label><b>Solicitação:</b></label><br>
            <select class="dropba" class="dropba" name="solicitacao">
              <option value="">Selecione a Solicitação</option>
            </select>
        </div>
        <br>
        <b>Anexo:</b> <br>
         <input type="file" name="anexo">
      <br><br>
        <b>Descrição:</b> 
        <div class="ui form fluid">
         <textarea style="resize: none" name="descricao" required></textarea>
        </div>

      </div>
</form>
    </div>
</div>