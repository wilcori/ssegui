<?php
require_once 'site/header.php';
require_once 'site/menu.php';
?>

      <div class="page-header">
        <h1>Cargos</h1>
      </div>
      <button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=cargos&action=nuevo'">Crear Nuevo Cargo</button>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Cargo</th>
                <th>Tipo Cargo</th>
                <th>Estado</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($allusers as $cargo) {?> 
              <tr>
                <td><?php echo $cargo->id; ?></td>
                <td><?php echo $cargo->cargo; ?></td>
                <td><?php echo $cargo->tipocargo; ?></td>
                <td><?php echo ($cargo->estado == 1) ? 'Activo' : 'Inactivo'; ?></td>
                <td><button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=cargos&action=editar&id=<?=$cargo->id?>'">Editar</button></td>
              </tr>
            <?php } ?>              
            </tbody>
          </table>
        </div>
<?php
require_once 'site/foot.php';
?>
