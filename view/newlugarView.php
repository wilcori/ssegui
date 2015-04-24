<?php
require_once 'site/header.php';
require_once 'site/menu.php';
?>

      <div class="page-header">
        <h1>Cite</h1>
      </div>
<form role="form" method="post" action="<?php echo $helper->url("cite","addcite"); ?>">
<div class="row">
    <div class="col-xs-12 col-md-12">
      <div class="form-group">
        <label for="tcreacion">Tipo Creación:</label>
        <select name="tcreacion" class="form-control" id="tcreacion" required autofocus>
          <option value="estructura">Orden Organigrama</option>
          <option value="custom">Personalizado</option>
        </select>
      </div>
      <div class="form-group">
        <label for="acronimo">Acrónimo:</label>
        <input type="text" name="acronimo" value="" class="form-control" id="acronimo" placeholder="Introduce el Cite" required>
      </div>
    <div class="form-group">
        
      <label for="estructura">Estructura Orgánica:</label>
      <select name="estructura" class="form-control" id="estructura" required>
        <?php foreach ($estructuraall as $struct) { ?>
        <option value="<?php echo $struct->id ?>"><?php echo $struct->nombre ?></option>
        <?php } ?>
      </select>
    </div>
      <div class="form-group">
        <label for="contador">Contador:</label>
        <input type="text" name="contador" value="0" class="form-control" id="contador" placeholder="Introduce Correlativo" required>
      </div>
      <div class="form-group">
        <label for="estado">Estado:</label><br>
        <input type="radio" name="estado" value="1" checked> Activo&nbsp;
        <input type="radio" name="estado" value="0"> Inactivo
      </div>
        
    </div>              
  <div class="row">
    <div class="col-xs-12">
      <input type="submit" class="btn btn-default" name="guardar" value="Guardar" />
      <input type="button" class="btn btn-default" name="cancelar" value="Cancelar" onclick="location.href='index.php?controller=Bandejas&action=salida'" />      
    </div>
  </div>

</div>
    </form>
<?php
require_once 'site/foot.php';
?>
