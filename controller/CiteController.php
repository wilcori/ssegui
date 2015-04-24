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
        $estruct = new Estructura();
        $datosest = $estruct->getAll();
//        print_r($datosest);
        $this->view('newcite', array(
            'estructuraall'=>$datosest,
            'title' => 'Nuevo Cite'
        ));
    }
    
    public function addcite(){
//        $cite  = new Cite();
        if(isset($_POST["guardar"])){
//            echo $_POST["estructura"].'<br>';
//            echo $_POST['acronimo'];
//            exit();
            // verificar si existe el cargo
            $cite  = new Cite();
            if($cite->getCiteExistente($_POST["estructura"])){
//                echo 'asdfa'; exit();
                $this->redirect("cite", "index");
            } else {
                // unset($verificaCargo);
                //Creamos un Cargo
                // $usuario=new Cargos();
                $cite->setIdestructura($_POST["estructura"]);
                $cite->setAcronimo($_POST["acronimo"]);
                $cite->setContador($_POST["contador"]);
                $cite->setTipocreacion($_POST["tcreacion"]);
                $cite->setEstado($_POST["estado"]);
                $save=$cite->save();
            }
        }
        $this->redirect("cite", "index");
        
    }
    
}
