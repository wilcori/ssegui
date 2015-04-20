<?php
require_once 'site/header.php';
require_once 'site/menu.php';
$cargo = (isset($_POST['cargo'])) ? $_POST['cargo'] : '';
$tcargo = (isset($_POST['tcargo'])) ? $_POST['tcargo'] : '';
?>

      <div class="page-header">
        <h1>Nuevo Cargo</h1>
      </div>

    <form role="form" method="post" action="<?php echo $helper->url("cargos","crear"); ?>">
<div class="row">
  <div class="col-xs-12 col-md-12">
      <div class="form-group">
        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" value="<?php echo $cargo;?>" class="form-control" id="cargo" placeholder="Introduce Cargo" required autofocus>
      </div>
      <div class="form-group">
        <label for="tcargo">Tipo de Cargo:</label>
        <input type="text" name="tcargo" value="<?php echo $tcargo;?>" class="form-control" id="tcargo" placeholder="Introduce Tipo de Cargo" required>
      </div>
      <div class="form-group">
        <label for="estado">Estado:</label><br>
        <input type="radio" name="estado" value="1" checked> Activo<br>
        <input type="radio" name="estado" value="0"> Inactivo<br>
      </div>
      <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" class="form-control" placeholder="Introduce Descripción"></textarea>
      </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <input type="submit" class="btn btn-default" name="guardar" value="Guardar" />
      <input type="button" class="btn btn-default" name="cancelar" value="Cancelar" onclick="location.href='index.php?controller=cargos&action=index'" />      
    </div>
  </div>

</div>
    </form>

<?php
require_once 'site/foot.php';
?>
