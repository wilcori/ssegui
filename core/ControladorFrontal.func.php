<?php
//FUNCIONES PARA EL CONTROLADOR FRONTAL

function cargarControlador($controller){
    $controlador=ucwords($controller).'Controller';
    $strFileController='controller/'.$controlador.'.php';

    if(!is_file($strFileController)){
        $controlador=ucwords(CONTROLADOR_DEFECTO).'Controller';
        $strFileController='controller/'.ucwords(CONTROLADOR_DEFECTO).'Controller.php'; 

    }
    require_once $strFileController;
    $controllerObj=new $controlador();
    return $controllerObj;
}

function cargarAccion($controllerObj,$action){
    $accion=$action;
    $controllerObj->$accion();
}

function lanzarAccion($controllerObj){
    session_start();
    if ( isset($_POST['email']) && isset($_POST['pass'] )) {

        if(isset($_GET["action"]) && method_exists($controllerObj, $_GET["action"])){
            
            cargarAccion(cargarControlador('usuarios'), $_GET["action"]);
        }else{

            cargarAccion($controllerObj, ACCION_DEFECTO);
        }        
    } else {

        if(isset($_SESSION['email'])){ 

            if(isset($_GET["action"]) && method_exists($controllerObj, $_GET["action"])){
//                echo 'sisisi';
                cargarAccion($controllerObj, $_GET["action"]);
            }else{
                cargarAccion($controllerObj, ACCION_DEFECTO);
            }
        } else {
            $controllerObj=cargarControlador('usuarios');
            cargarAccion($controllerObj, 'viewLogin');
        }

    }    
}

?>
