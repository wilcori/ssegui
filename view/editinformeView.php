<?php
require_once 'site/header.php';
require_once 'site/menu.php';
?>

      <div class="page-header">
        <h1><?php echo $title?></h1>
      </div>
<form role="form" method="post" action="<?php echo $helper->url("documento","editarinforme"); ?>">
<div class="row">
  <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <label for="lugar">Lugar:</label>
        <select name="lugar" class="form-control" id="lugar" placeholder="Introduce Lugar" required autofocus>
          <option value="LP" <?php echo ($documento->lugar == 'LP') ? 'selected' : ''; ?>>La Paz</option>
          <option value="CB" <?php echo ($documento->lugar == 'CB') ? 'selected' : ''; ?>>Cochabamba</option>
          <option value="SC" <?php echo ($documento->lugar == 'SC') ? 'selected' : ''; ?>>Santa Cruz</option>
          <option value="TA" <?php echo ($documento->lugar == 'TA') ? 'selected' : ''; ?>>Tarija</option>
          <option value="PO" <?php echo ($documento->lugar == 'PO') ? 'selected' : ''; ?>>Potosí</option>
          <option value="OR" <?php echo ($documento->lugar == 'OR') ? 'selected' : ''; ?>>Oruro</option>
          <option value="BE" <?php echo ($documento->lugar == 'BE') ? 'selected' : ''; ?>>Beni</option>
          <option value="PA" <?php echo ($documento->lugar == 'PA') ? 'selected' : ''; ?>>Pando</option>
          <option value="CH" <?php echo ($documento->lugar == 'CH') ? 'selected' : ''; ?>>Chuquisaca</option>
        </select>
      </div>
      <div class="form-group">
        <label for="fecha">Fecha:</label>
        <input type="text" name="fecha" value="<?php echo $documento->fechahora ?>" class="form-control" id="fecha" placeholder="Introduce la fecha" autocomplete="off" required>
      </div>
      <div class="form-group">
        <label for="cite">Cite:</label>
        <input type="text" name="cite" value="<?php echo $documento->cite ?>" readonly="readonly" class="form-control" id="cite" placeholder="Introduce el Cite" required>
      </div>
    </div>      
    <div class="col-xs-12 col-md-6">
      <div class="form-group">
        <label for="cite">Remitente:</label>
        <select class="form-control" id="remitente" multiple="multiple" name="remitente[]" style="width: 100%" placeholder="elija los remitentes">
            <?php
            foreach ($funcionarios as $k => $nombres  ){
                echo '<option value="'.$nombres->id.'"';
                if(is_array($documento->remitente)){
                   foreach ($documento->remitente as $val){
                        if($val->id == $nombres->id){
                            echo ' selected ';
                        }
                    }
                }
                echo  '>'.$nombres->nombres.' '.$nombres->apellidos.'</option>';
            }
            ?>
        </select>
      </div>
      <div class="form-group">
        <label for="cite">Destinatario:</label>
        <select class="form-control" id="destinatario" multiple="multiple" name="destinatario[]" style="width: 100%" placeholder="elija los destinos">
            <?php            
            foreach ($funcionarios as $k => $nombres  ){
                echo '<option value="'.$nombres->id.'"';
                if(is_array($documento->destinatario)){
                    foreach ($documento->destinatario as $val){
                        if($val->id == $nombres->id){
                            echo ' selected ';
                        }
                    }
                }
                echo  '>'.$nombres->nombres.' '.$nombres->apellidos.'</option>';
            } 
            ?>
        </select>
      </div>
      <div class="form-group">
        <label for="referencia">Referencia:</label>
        <input type="text" name="referencia" value="<?php echo $documento->referencia ?>" class="form-control" id="referencia" placeholder="Introduce referencia" required>
      </div>
    </div>
    <div class="col-xs-12 col-md-12">        
      <div class="form-group">
        <label for="tenor">Tenor:</label>
        <textarea name="tenor" class="form-control" placeholder="Introduce Tenor"><?php echo $documento->tenor ?></textarea>
      </div>
    </div>
    <div class="col-xs-12 col-md-6"> 
      <div class="form-group">
        <label for="">Nro Anexos:</label>
        <input type="nroanexos" name="nroanexos" value="<?php echo $documento->nroanexos ?>" class="form-control" id="nroanexos" placeholder="nroanexos" required>
      </div>
      <div class="form-group">
        <label for="anexos">Anexos:</label>
        <input type="text" name="anexos" value="<?php echo $documento->anexos ?>" class="form-control" id="anexos" placeholder="Introduce anexos" required>
      </div>
    </div>
    <div class="col-xs-12 col-md-6"> 
      <div class="form-group">
        <label for="nrofolios">Nro Folios:</label>
        <input type="text" name="nrofolios" value="<?php echo $documento->nrofolios ?>" class="form-control" id="nrofolios" placeholder="Introduce nrofolios" required>
      </div>
      <div class="form-group">
        <label for="concopia">Con Copia:</label>
        <select class="form-control" id="concopia" multiple="multiple" name="concopia[]" style="width: 100%">
            <?php            
            foreach ($funcionarios as $k => $nombres  ){
                echo '<option value="'.$nombres->id.'"';
                if(is_array($documento->concopia)){
                    foreach ($documento->concopia as $val){
                        if($val->id == $nombres->id){
                            echo ' selected ';
                        }
                    }
                }
                echo  '>'.$nombres->nombres.' '.$nombres->apellidos.'</option>';
            }
            ?>
        </select>
      </div>        
    </div>
  <div class="row">
    <div class="col-xs-12">
        <input type="hidden" value="<?php echo $documento->id ?>" name="id" />
      <input type="submit" class="btn btn-default" name="guardar" value="Guardar" />
      <input type="button" class="btn btn-default" name="cancelar" value="Cancelar" onclick="location.href='index.php?controller=Bandejas&action=salida'" />
      <input type="button" class="btn btn-default" name="borrar" value="Eliminar" id="delete" onclick="location.href='index.php?controller=documento&action=borrardocumento&id=<?php echo $documento->id?>'" />
    </div>
  </div>
</div>
    </form>
<script>tinymce.init({selector:'textarea'});</script>

<?php
require_once 'site/foot.php';
?>
