<?php
require_once 'site/header.php';
require_once 'site/menu.php';
?>

      <div class="page-header">
        <h1>Editar Usuarios</h1>
      </div>

    <form role="form" method="post" action="<?php echo $helper->url("usuarios","guardarEditar"); ?>">
<div class="row">
  <div class="col-xs-12 col-md-4">

    <input type="hidden" name="id" value="<?php echo $allusers->id;?>">
      <div class="form-group">
        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres" value="<?php echo $allusers->nombres;?>" class="form-control" id="nombres" placeholder="Introduce Nombre" required autofocus>
      </div>
      <div class="form-group">
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" value="<?php echo $allusers->apellidos;?>" class="form-control" id="apellidos" placeholder="Introduce Apellidos" required>
      </div>
      <div class="form-group">
        <label for="ci">Carnet de Identidad:</label>
        <input type="text" name="ci" value="<?php echo $allusers->ci;?>" class="form-control" id="ci" placeholder="Introduce CI" required>
      </div>
      <div class="form-group">
        <label for="extension">Extensión CI:</label>
        <select name="extension" class="form-control" id="extension" placeholder="Introduce la extension" required>
          <option value="">Seleccione una extensión</option>
          <option value="LP" <?php echo ($allusers->extension == 'LP') ? 'selected' : ''; ?>>La Paz</option>
          <option value="CB" <?php echo ($allusers->extension == 'CB') ? 'selected' : ''; ?>>Cochabamba</option>
          <option value="SC" <?php echo ($allusers->extension == 'SC') ? 'selected' : ''; ?>>Santa Cruz</option>
          <option value="TA" <?php echo ($allusers->extension == 'TA') ? 'selected' : ''; ?>>Tarija</option>
          <option value="PO" <?php echo ($allusers->extension == 'PO') ? 'selected' : ''; ?>>Potosí</option>
          <option value="OR" <?php echo ($allusers->extension == 'OR') ? 'selected' : ''; ?>>Oruro</option>
          <option value="BE" <?php echo ($allusers->extension == 'BE') ? 'selected' : ''; ?>>Beni</option>
          <option value="PA" <?php echo ($allusers->extension == 'PA') ? 'selected' : ''; ?>>Pando</option>
          <option value="CH" <?php echo ($allusers->extension == 'CH') ? 'selected' : ''; ?>>Chuquisaca</option>
        </select>
      </div>
      <div class="form-group">
        <label for="fnacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fnacimiento" value="<?php echo $allusers->fnacimiento;?>" class="form-control" id="fnacimiento" placeholder="Introduce Fecha Nacimiento" required >
      </div>
  </div>
  <div class="col-xs-6 col-md-4">
      <div class="form-group">
        <label for="telefono">Teléfono Fijo:</label>
        <input type="text" name="telefono" value="<?php //echo $allusers->nombres;?>" class="form-control" id="celular" placeholder="Introduce tu teléfono">
      </div>
      <div class="form-group">
        <label for="celular">Teléfono Celular:</label>
        <input type="text" name="celular" value="<?php //echo $allusers->nombres;?>" class="form-control" id="celular" placeholder="Introduce tu teléfono">
      </div>
      <div class="form-group">
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" value="<?php //echo $allusers->nombres;?>" class="form-control" id="direccion" placeholder="Introduce tu dirección">
      </div>
  </div>
  <div class="col-xs-6 col-md-4">
      <div class="form-group">
        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" value="<?php //echo $allusers->nombres;?>" class="form-control" id="cargo" placeholder="Introduce tu cargo">
      </div>
      <div class="form-group">
        <label for="celular">Fecha Ingreso:</label>
        <input type="text" name="celular" value="<?php //echo $allusers->nombres;?>" class="form-control" id="celular" placeholder="Introduce tu teléfono">
      </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <input type="submit" class="btn btn-default" name="guardar" value="Guardar" />
      <input type="button" class="btn btn-default" name="cancelar" value="Cancelar" onclick="location.href='index.php'" />      
    </div>
  </div>

</div>
    </form>

<?php
require_once 'site/foot.php';
?>
