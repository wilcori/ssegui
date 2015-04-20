<?php
include "core/Helpers.php";
/**
* autor: whilaquita
* Proyecto SSEGUI
**/
class DocumentoController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    // public function index(){
    //     $this->redirect("Bandejas", "salida");
    // }

    public function newcarta(){
        //Creamos el objeto usuario
        $documento = new Documento();
        $funcionarios = $documento->getUsuarioAll();
        $this->view("newcarta",array(
            "remitente"=>$funcionarios,
            "destino" => $funcionarios,
            "concopia" => $funcionarios,
            "title"    =>"Nuevo Carta"
        ));        
    }

    public function editcarta(){
        //Creamos el objeto usuario
        $documento = new Documento();
        $funcionarios = $documento->getUsuarioAll();
        
        $fec = new Helpers();
        
        //verificamos el id del documento
        if(isset($_GET['id']) && $_GET['id'] > 0 && is_int((int)$_GET['id'])){
            //obtenemos los datos del documentos elegido
            $documentoId = $documento->getById($_GET['id']);
            
            //Obteniendo los remitentes
            $remitente = $documento->getRemitente($_GET['id']);            
            $documentoId->remitente = $remitente;
            
            //Obteniendo los destinatarios
            $destinatario = $documento->getDestinatario($_GET['id']);
            $documentoId->destinatario = $destinatario;
            //Obteniendo los concopia
            $concopia = $documento->getConcopia($_GET['id']);
            $documentoId->concopia = $concopia;
            
            $documentoId->fechahora = $fec->cambiaf_a_normal($documentoId->fechahora);
            $this->view("editcarta",array(
                'documento'=>$documentoId,
                'funcionarios' => $funcionarios,
                'title'    =>"Editar Carta"
            ));                    
        } else {
            $this->view('bandejas', 'salida');
        }
    }

    /**
    * Descripión: Crea el resgisto de un documento
    **/
    public function crearcarta(){
        if(isset($_POST["guardar"])){
            // verificar si existe el cargo
            $carta = new Documento();
            
            $fec = new Helpers();

            $carta->setIdtipodocumento(1);
            $carta->setIdformato(1);
            $carta->setIdusuario($_SESSION['id']);
            $carta->setHost('localhost');
            $carta->setLugar($_POST['lugar']);
            $carta->setFechahora($fec->cambiaf_a_mysql($_POST['fecha']));
            $carta->setFecharegistro(date('Y-m-d H:m:s'));
            $carta->setCite($_POST['cite']);
            $carta->setReferencia($_POST['referencia']);
            $carta->setTenor($_POST['tenor']);
            $carta->setNroanexos($_POST['nroanexos']);
            $carta->setAnexos($_POST['anexos']);
            $carta->setNrofolios($_POST['nrofolios']);
            $carta->setEstado(1);
            $save=$carta->save();
            
            $idDoc = $carta->getIdidentity();
            //Obtenemos los remitentes
            if(isset($_POST['remitente'])) {
                $remit = new Remitente();
                foreach ($_POST['remitente'] as $val){
                    $remit->setIddocumento($idDoc);
                    $remit->setIdactividadusuario($val);
                    $resremit = $remit->save();
                }
            }
            //Obtenemos los destinatarios 
            if(isset($_POST['destinatario'])) {
                $dest = new Destinatario();
                foreach ($_POST['destinatario'] as $val){
                    $dest->setIddocumento($idDoc);
                    $dest->setIdactividadusuario($val);
                    $resremit = $dest->save();
                }
            }
            //Obtenemos los con copia 
            if(isset($_POST['concopia'])) {
                $ccopia = new Concopia();
                foreach ($_POST['concopia'] as $val){
                    $ccopia->setIddocumento($idDoc);
                    $ccopia->setIdactividadusuario($val);
                    $ccopiaf = $ccopia->save();
                }
            }
            
        }
        $this->redirect("bandejas", "salida");
    }

        /**
    * Descripión: Crea el resgisto de un documento
    **/
    public function editarcarta(){
        if(isset($_POST["guardar"])){
            // verificar si existe el cargo
            $carta = new Documento();
            
            $fec = new Helpers();

            $carta->setId((int)$_POST['id']);
            $carta->setIdtipodocumento(1);
            $carta->setIdformato(1);
            $carta->setIdusuario($_SESSION['id']);
            $carta->setHost('localhost');
            $carta->setLugar($_POST['lugar']);
            $carta->setFechahora($fec->cambiaf_a_mysql($_POST['fecha']));
            $carta->setFecharegistro(date('Y-m-d H:m:s'));
            $carta->setCite($_POST['cite']);
            $carta->setReferencia($_POST['referencia']);
            $carta->setTenor($_POST['tenor']);
            $carta->setNroanexos($_POST['nroanexos']);
            $carta->setAnexos($_POST['anexos']);
            $carta->setNrofolios($_POST['nrofolios']);
            $carta->setEstado(1);
            $update=$carta->update();
            
//            $idDoc = $carta->getIdidentity();
            //Obtenemos los remitentes
            if(isset($_POST['remitente'])) {
                $remit = new Remitente();
                $remit->deleteBy('iddocumento', $_POST['id']);
                foreach ($_POST['remitente'] as $val){
                    $remit->setIddocumento($_POST['id']);
                    $remit->setIdactividadusuario($val);
                    $resremit = $remit->save();
                }
            }
            //Obtenemos los destinatarios 
            if(isset($_POST['destinatario'])) {
                $dest = new Destinatario();
                $dest->deleteBy('iddocumento', $_POST['id']);
                foreach ($_POST['destinatario'] as $val){
                    $dest->setIddocumento($_POST['id']);
                    $dest->setIdactividadusuario($val);
                    $resremit = $dest->save();
                }
            }
            //Obtenemos los con copia 
            if(isset($_POST['concopia'])) {
                $ccopia = new Concopia();
                $ccopia->deleteBy('iddocumento', $_POST['id']);
                foreach ($_POST['concopia'] as $val){
                    $ccopia->setIddocumento($_POST['id']);
                    $ccopia->setIdactividadusuario($val);
                    $ccopiaf = $ccopia->save();
                }
            }
            
        }
        $this->redirect("bandejas", "salida");
    }

    public function borrarcarta(){       
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $carta = new Documento();
            
            $id = (int)$_GET['id'];
            $carta->borrar($id);
        }   
        $this->redirect("bandejas", "salida");        
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
        
        //Conseguimos todos los usuarios
        $allusers = $bandeja->getAll();

        //Creamos el objeto usuario
        $this->view("bandejassalida",array(
            "allusers"=>$allusers,
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
