<?php

/**
 * Description of CiteController
 *
 * @author whilaquita
 */
class CiteController  extends ControladorBase{

    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        //Creamos el objeto usuario
        $cite = new Cite();
        
        //Conseguimos todos los usuarios
        $allcite = $cite->getAcronimoAll();
       
        //Cargamos la vista index y le pasamos valores
        $this->view("cite",array(
            "allcite"=>$allcite,
            "title"    =>"SSEGUI - Cite"
        ));
    }
    
    public function newcite(){
        $this->view('newcite', array());
    }
    
}
