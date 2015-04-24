<?php
require_once 'site/header.php';
require_once 'site/menu.php';
//$cite = (isset($cite))
if(!isset($cite)){
    $cite = '';
}
?>

      <div class="page-header">
        <h1><?php echo $title?></h1>
      </div>
<form role="form" method="post" action="<?php echo $helper->url("documento","crearcircular"); ?>">
<div class="row">
  <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <label for="fecha">Fecha:</label>
        <input type="text" name="fecha" value="" class="form-control" id="fecha" placeholder="Introduce la fecha" autocomplete="off" required>
      </div>
      <div class="form-group">
        <label for="cite">Cite:</label>
        <input type="text" name="cite" value="<?php echo $cite ?>" readonly="readonly" class="form-control" id="cite" placeholder="Introduce el Cite" required>
      </div>
    </div>      
    <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <label for="cite">Remitente:</label>
        <select class="form-control" id="remitente" multiple="multiple" name="remitente[]" style="width: 100%" placeholder="elija los remitentes">
            <?php
            foreach ($remitente as $nombres){
                echo '<option value="'.$nombres->id.'">'.$nombres->nombres.' '.$nombres->apellidos.'</option>';
            }
            ?>
        </select>
      </div>
      <div class="form-group">
        <label for="referencia">Referencia:</label>
        <input type="text" name="referencia" value="" class="form-control" id="referencia" placeholder="Introduce referencia" required>
      </div>
    </div>
    <div class="col-xs-12 col-md-12">        
      <div class="form-group">
        <label for="tenor">Tenor:</label>
        <textarea name="tenor" class="form-control" placeholder="Introduce Tenor"></textarea>
      </div>
    </div>
    <div class="col-xs-12 col-md-12"> 
      <div class="form-group">
        <label for="concopia">Con Copia:</label>
        <select class="form-control" id="concopia" multiple="multiple" name="concopia[]" style="width: 100%">
            <?php
            foreach ($concopia as $nombres){
                echo '<option value="'.$nombres->id.'">'.$nombres->nombres.' '.$nombres->apellidos.'</option>';
            }
            ?>
        </select>
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
<script>tinymce.init({
    selector:'textarea',
    languaje:'es',
        });
</script>

<?php
require_once 'site/foot.php';
?>
