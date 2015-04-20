<?php
require_once 'site/header.php';
require_once 'site/menu.php';
?>

      <div class="page-header">
        <h1>Usuarios Wilmer</h1>
      </div>
      <button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=usuarios&action=editar&id=<?=$user->id?>'">Crear Nuevo Usuario</button>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>CI</th>
                <th>email</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($allusers as $user) {?>            
              <tr>
                <td><?php echo $user->id; ?></td>
                <td><?php echo $user->nombres; ?> <?php echo $user->apellidos; ?></td>
                <td><?php echo $user->ci; ?></td>
                <td><?php echo $user->email; ?></td>
                <td><button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=usuarios&action=editar&id=<?=$user->id?>'">Editar</button></td>
              </tr>
            <?php } ?>              
            </tbody>
          </table>
        </div>
<?php
require_once 'site/foot.php';
?>
