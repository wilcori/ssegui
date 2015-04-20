<?php
class BandejasController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->redirect("Bandejas", "salida");
    }

    /**
    * Descripión: Representa a la canastilla de entrada de documentos
    **/
    public function Entrada(){
        //Creamos el objeto usuario
        $this->view("bandejasentrada",array(
            "allusers"=>'holitas',
            "title"    =>"Badeja de Entrada"
        ));
    }

    /**
    * Descripión: Representa a la canastilla de salida de documentos
    **/
    public function Salida(){
        //Creamos el objeto usuario
        $bandeja = new Documento();
        $remit = '';
        $dest = '';
        //Conseguimos todos los usuarios
        $documento = $bandeja->getBandejaSalida();

        foreach ($documento as $k => $v){
            //Obteniendo los remitentes
            $remitente = $bandeja->getRemitente($documento[$k]->id);            
            if($remitente){
                foreach ($remitente as $k2 => $v2){

                    $remit .= $remitente[$k2]->nombres .' '.''.$remitente[$k2]->apellidos;
                    if($k2 < count($remitente) - 1) {
                        $remit .= '<br>';
                    }
                }
            }
            
            $documento[$k]->remite = $remit;
            $remit = '';
            //Obteniendo los destinatarios
            $destino = $bandeja->getDestinatario($documento[$k]->id);            
            if($destino){
                foreach ($destino as $k2 => $v2){

                    $dest .= $destino[$k2]->nombres .' '.''.$destino[$k2]->apellidos;
                    if($k2 < count($destino) - 1) {
                        $dest .= '<br>';
                    }
                }
            }
            

            $documento[$k]->destino = $dest;
            $dest = '';

//            $remitente = '';
        }

        
        //Creamos el objeto usuario
        $this->view("bandejassalida",array(
            "documento"=>$documento,
            "title"    =>"Badeja de Entrada"
        ));
    }

    /**
    * Descripión: Representa a la canastilla de envidadas de documentos
    **/
    public function Enviadas(){
        //Creamos el objeto usuario
        $this->view("bandejasenviadas",array(
            "allusers"=>'holitas',
            "title"    =>"Badeja de Entrada"
        ));
    }
    
}
?>
