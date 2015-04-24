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
          <button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=documento&action=newcomunicado'">Crear comunicado</button>
          <button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=documento&action=newcircular'">Crear circular</button>
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
            <?php 
            $c = 0;
            foreach($documento as $doc) {?> 
              <tr>
                <td><?php echo ++$c; ?></td>
                <td><?php echo $doc->documento; ?></td>
                <td><?php echo $doc->referencia; ?></td>
                <td><?php echo $doc->remite; ?></td>
                <td><?php echo $doc->destino; ?></td>
                <td>
                    <button class="btn btn-xs btn-primary" onClick="location.href='index.php?controller=documento&action=edit<?php echo strtolower($doc->tipodocumento) ?>&id=<?=$doc->id?>'">Editar</button>
                    <button class="btn btn-xs btn-primary" onClick="location.href='#'">Enviar</button>
                    <button class="btn btn-xs btn-primary" onClick="window.open( 'http://<?php echo $_SERVER["SERVER_NAME"]?>//index.php?controller=documento&action=print<?php echo strtolower($doc->tipodocumento) ?>&id=<?=$doc->id?>');">Imprimir</button>
                </td>
              </tr>
            <?php } ?>              
            </tbody>
          </table>

        </div>
<?php
require_once 'site/foot.php';
?>
