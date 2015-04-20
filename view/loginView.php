<?php
require_once 'site/header.php';

?>
<div class="container">   
  <form class="form-signin" action="<?php echo $helper->url("usuarios","validar"); ?>" method="post">
    <h2 class="form-signin-heading">Area de Restricción:</h2>
    <label for="inputEmail" class="sr-only">Correo Electrónico:</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Correo Electrónico" required autofocus>
    <label for="inputPassword" class="sr-only">Contraseña</label>
    <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Contraseña" required>
    <div class="checkbox">
    <label>
    <input type="checkbox" value="remember-me"> Recordarme
    </label>
    </div>
    <input name="ingresar" class="btn btn-lg btn-primary btn-block" type="submit" value="I n g r e s a r">
  </form>
</div> <!-- /container -->
<?php
require_once 'site/foot.php';
?>