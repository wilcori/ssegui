<?php
require_once 'site/header.php';
require_once 'site/menu.php';
?>

      <div class="page-header">
        <h1>Cite</h1>
      </div>
      <button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=cite&action=newcite'">Crear Nuevo Cite</button>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Área, Acrónimo y Contador</th>
                <th>Estado</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($allcite as $cite) {?> 
              <tr>
                <td><?php echo $cite->id; ?></td>
                <td><?php echo $cite->nombre; ?><br><b><?php echo $cite->acronimo; ?>-<?php echo $cite->contador; ?></b></td>
                <td><?php echo ($cite->estado == 1) ? 'Activo' : 'Inactivo'; ?></td>
                <td><button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=cargos&action=editar&id=<?=$cargo->id?>'">Editar</button></td>
              </tr>
            <?php } ?>              
            </tbody>
          </table>
        </div>
<?php
require_once 'site/foot.php';
?>
