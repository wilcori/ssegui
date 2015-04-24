<?php

/**
 * Description of LugarController
 *
 * @author wilmer
 */
class LugarController extends ControladorBase{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        //Creamos el objeto usuario
        $lugar = new Lugar();
        
        //Conseguimos todos los usuarios
        $todos = $lugar->getAll();
//       print_r($todos);
//       exit();
        //Cargamos la vista index y le pasamos valores
        $this->view("lugar",array(
            "todititos"=>$todos,
            "title"    =>"SSEGUI - Lugar"
        ));
    }
    
    public function newlugar(){
        echo 'llego';
        exit();
    }
    
}
