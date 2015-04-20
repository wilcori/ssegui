<?php
require_once 'site/header.php';
require_once 'site/menu.php';
?>

      <div class="page-header">
        <h1>Editar Cargo</h1>
      </div>

    <form role="form" method="post" action="<?php echo $helper->url("cargos","update"); ?>">
    <input type="hidden" name="id" value="<?php echo $allusers->id;?>">
<div class="row">
  <div class="col-xs-12 col-md-12">
      <div class="form-group">
        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" value="<?php echo $allusers->cargo;?>" class="form-control" id="cargo" placeholder="Introduce Cargo" required autofocus>
      </div>
      <div class="form-group">
        <label for="tcargo">Tipo de Cargo:</label>
        <input type="text" name="tcargo" value="<?php echo $allusers->tipocargo;?>" class="form-control" id="tcargo" placeholder="Introduce Tipo de Cargo" required>
      </div>
      <div class="form-group">
        <label for="estado">Estado:</label><br>
        <input type="radio" name="estado" value="1" <?php echo ($allusers->estado == 1) ? 'checked' : '';?>> Activo<br>
        <input type="radio" name="estado" value="0" <?php echo ($allusers->estado == 0) ? 'checked' : '';?>> Inactivo<br>
      </div>
      <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" class="form-control" placeholder="Introduce Descripción"><?php echo $allusers->descripcion;?></textarea>
      </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <input type="submit" class="btn btn-default" name="guardar" value="Guardar" />
      <input type="button" class="btn btn-default" name="cancelar" value="Cancelar" onclick="location.href='index.php?controller=cargos&action=index'" />
      <input type="button" class="btn btn-default" name="cancelar" value="Elminar" onclick="location.href='index.php?controller=cargos&action=borrar'" />
    </div>
  </div>

</div>
    </form>

<?php
require_once 'site/foot.php';
?>
