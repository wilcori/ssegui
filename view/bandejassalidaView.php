<?php
require_once 'site/header.php';
require_once 'site/menu.php';
?>

      <div class="page-header">
        <h1>Bandejas</h1>
      </div>
      <div class="row">
        <div class="col-md-12">

          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#">Salida</a></li>
            <li role="presentation"><a href="index.php?controller=Bandejas&action=enviadas">Enviados</a></li>
            <li role="presentation"><a href="index.php?controller=Bandejas&action=entrada">Entrada</a></li>
          </ul>
          <button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=documento&action=newcarta'">Crear carta</button>
          <button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=documento&action=newinforme'">Crear informe</button>
          <button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=documento&action=newcircular'">Crear circular</button>
          <button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=documento&action=newcomunicado'">Crear comuicado</button>
          <button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=documento&action=newmemorandum'">Crear memorandum</button>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Tipo Documento</th>
                <th>Referencia</th>
                <th>Emisores</th>
                <th>Destino</th>
                <th>&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($documento as $cargo) {?> 
              <tr>
                <td><?php echo $cargo->id; ?></td>
                <td><?php echo $cargo->documento; ?></td>
                <td><?php echo $cargo->referencia; ?></td>
                <td><?php echo $cargo->remite; ?></td>
                <td><?php echo $cargo->destino; ?></td>
                <td><button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=documento&action=editcarta&id=<?=$cargo->id?>'">Editar</button></td>
              </tr>
            <?php } ?>              
            </tbody>
          </table>

        </div>
<?php
require_once 'site/foot.php';
?>
