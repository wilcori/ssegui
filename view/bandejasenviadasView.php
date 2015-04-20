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
            <li role="presentation"><a href="index.php?controller=Bandejas&action=salida">Salida</a></li>
            <li role="presentation" class="active"><a href="#">Enviados</a></li>
            <li role="presentation"><a href="index.php?controller=Bandejas&action=entrada">Entrada</a></li>
          </ul>

        </div>
<?php
require_once 'site/foot.php';
?>
