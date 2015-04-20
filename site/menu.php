    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Seguimiento</a>
        </div>
        <!-- Menu -->
        <div id="navbar" class="navbar-collapse collapse">
<?php
        $usuario = new Recurso();
        require_once "core/Helpers.php";
        require_once "controller/RecursoController.php";
        $getMenu = new RecursoController();
        $menu = new Helpers(); 
        $new = array(); 
        $arr = $usuario->getRecurso();
        foreach ($arr as $a){ 
            $new[$a['idrecurso']][] = $a;
        }
        $arrayMenu = $getMenu->createTree($new, $new[0]); 
        
        $menu->generateMenu($arrayMenu, ' class="nav navbar-nav"', $lmenu = '');
?>

        </div><!--Fin Menu -->
      </div>
    </nav>
    
<!--    <div class="container theme-showcase" role="main"> -->