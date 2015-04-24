<?php
include "core/Helpers.php";
include "core/pdf.php";
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
        
        if($documento->getCiteExistDoc($_SESSION['id'])){
            $cite = $documento->getCiteExistDoc($_SESSION['id']);
            $funcionarios = $documento->getUsuarioAll();
            $this->view("newcarta",array(
                "remitente" => $funcionarios,
                "destino"   => $funcionarios,
                "concopia"  => $funcionarios,
                "cite"  => $cite,
                "title"     => "Nuevo Carta"
            ));
        } else {
            //agregar codigo para enviar el mensaje de error
            $this->redirect("bandejas", "salida");
        }
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
            
            $cite = new Cite();
            $idCite = $cite->getCiteIncrementContador($_SESSION['id']);
//            print_r($idCite);
//            echo 'asdfadf';
//            exit();
            $cite->updateContadorCite($idCite);
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

    public function borrardocumento(){       
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $carta = new Documento();
            
            $id = (int)$_GET['id'];
            $carta->borrar($id);
        }   
        $this->redirect("bandejas", "salida");        
    }
    
    //Informes
    public function newinforme(){
        //Creamos el objeto usuario
        $documento = new Documento();
        
        if($documento->getCiteExistDoc($_SESSION['id'])){
            $cite = $documento->getCiteExistDoc($_SESSION['id']);
            $funcionarios = $documento->getUsuarioAll();
            $this->view("newinforme",array(
                "remitente" => $funcionarios,
                "destino"   => $funcionarios,
                "concopia"  => $funcionarios,
                "cite"  => $cite,
                "title"     => "Nuevo Informe"
            ));
        } else {
            //agregar codigo para enviar el mensaje de error
            $this->redirect("bandejas", "salida");
        }
    }

    public function crearinforme(){
        if(isset($_POST["guardar"])){
            // verificar si existe el cargo
            $carta = new Documento();
            
            $fec = new Helpers();

            $carta->setIdtipodocumento(2);
            $carta->setIdformato(2);
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
            
            $cite = new Cite();
            $idCite = $cite->getCiteIncrementContador($_SESSION['id']);
//            print_r($idCite);
//            echo 'asdfadf';
//            exit();
            $cite->updateContadorCite($idCite);
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

    public function editarinforme(){
        if(isset($_POST["guardar"])){
            // verificar si existe el cargo
            $carta = new Documento();
            
            $fec = new Helpers();

            $carta->setId((int)$_POST['id']);
            $carta->setIdtipodocumento(2);
            $carta->setIdformato(2);
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

    public function editinforme(){
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
            $this->view("editinforme",array(
                'documento'=>$documentoId,
                'funcionarios' => $funcionarios,
                'title'    =>"Editar Informe"
            ));                    
        } else {
            $this->view('bandejas', 'salida');
        }
    }

    //Comunicado
    public function newcomunicado(){
        //Creamos el objeto usuario
        $documento = new Documento();
        
        if($documento->getCiteExistDoc($_SESSION['id'])){
            $cite = $documento->getCiteExistDoc($_SESSION['id']);
            $funcionarios = $documento->getUsuarioAll();
            $this->view("newcomunicado",array(
                "remitente" => $funcionarios,
                "cite"  => $cite,
                "title"     => "Nuevo Comunicado"
            ));
        } else {
            //agregar codigo para enviar el mensaje de error
            $this->redirect("bandejas", "salida");
        }
    }

    public function crearcomunicado(){
        if(isset($_POST["guardar"])){
            // verificar si existe el cargo
            $carta = new Documento();
            
            $fec = new Helpers();

            $carta->setIdtipodocumento(3);
            $carta->setIdformato(3);
            $carta->setIdusuario($_SESSION['id']);
            $carta->setHost('localhost');
            $carta->setLugar(null);
            $carta->setFechahora($fec->cambiaf_a_mysql($_POST['fecha']));
            $carta->setFecharegistro(date('Y-m-d H:m:s'));
            $carta->setCite($_POST['cite']);
            $carta->setReferencia($_POST['referencia']);
            $carta->setTenor($_POST['tenor']);
            $carta->setNroanexos(null);
            $carta->setAnexos(null);
            $carta->setNrofolios(null);
            $carta->setEstado(1);
            $save=$carta->save();
            
            $cite = new Cite();
            $idCite = $cite->getCiteIncrementContador($_SESSION['id']);
            $cite->updateContadorCite($idCite);
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
            
        }
        $this->redirect("bandejas", "salida");
    }

    public function editarcomunicado(){
        if(isset($_POST["guardar"])){
            $carta = new Documento();
            
            $fec = new Helpers();

            $carta->setId((int)$_POST['id']);
            $carta->setIdtipodocumento(3);
            $carta->setIdformato(3);
            $carta->setIdusuario($_SESSION['id']);
            $carta->setHost('localhost');
            $carta->setLugar(null);
            $carta->setFechahora($fec->cambiaf_a_mysql($_POST['fecha']));
            $carta->setFecharegistro(date('Y-m-d H:m:s'));
            $carta->setCite($_POST['cite']);
            $carta->setReferencia($_POST['referencia']);
            $carta->setTenor($_POST['tenor']);
            $carta->setNroanexos(null);
            $carta->setAnexos(null);
            $carta->setNrofolios(null);
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
        }
        $this->redirect("bandejas", "salida");
    }

    public function editcomunicado(){
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
                        
            $documentoId->fechahora = $fec->cambiaf_a_normal($documentoId->fechahora);
            $this->view("editcomunicado",array(
                'documento'=>$documentoId,
                'funcionarios' => $funcionarios,
                'title'    =>"Editar Comunicado"
            ));                    
        } else {
            $this->view('bandejas', 'salida');
        }
    }

    //Circular
    public function newcircular(){
        //Creamos el objeto usuario
        $documento = new Documento();
        
        if($documento->getCiteExistDoc($_SESSION['id'])){
            $cite = $documento->getCiteExistDoc($_SESSION['id']);
            $funcionarios = $documento->getUsuarioAll();
            $this->view("newcircular",array(
                "remitente" => $funcionarios,
                "concopia"  => $funcionarios,
                "cite"  => $cite,
                "title"     => "Nuevo Circular"
            ));
        } else {
            //agregar codigo para enviar el mensaje de error
            $this->redirect("bandejas", "salida");
        }
    }

    public function crearcircular(){
        if(isset($_POST["guardar"])){

            $carta = new Documento();
            
            $fec = new Helpers();

            $carta->setIdtipodocumento(4);
            $carta->setIdformato(4);
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
            
            $cite = new Cite();
            $idCite = $cite->getCiteIncrementContador($_SESSION['id']);
            $cite->updateContadorCite($idCite);
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

    public function editarcircular(){
        if(isset($_POST["guardar"])){
            // verificar si existe el cargo
            $carta = new Documento();
            
            $fec = new Helpers();

            $carta->setId((int)$_POST['id']);
            $carta->setIdtipodocumento(2);
            $carta->setIdformato(2);
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

    public function editcircular(){
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
            
            //Obteniendo los concopia
            $concopia = $documento->getConcopia($_GET['id']);
            $documentoId->concopia = $concopia;
            
            $documentoId->fechahora = $fec->cambiaf_a_normal($documentoId->fechahora);
            $this->view("editcircular",array(
                'documento'=>$documentoId,
                'funcionarios' => $funcionarios,
                'title'    =>"Editar Circular"
            ));                    
        } else {
            $this->view('bandejas', 'salida');
        }
    }

    //Memorandum
    public function newmemorandum(){
        //Creamos el objeto usuario
        $documento = new Documento();
        
        if($documento->getCiteExistDoc($_SESSION['id'])){
            $cite = $documento->getCiteExistDoc($_SESSION['id']);
            $funcionarios = $documento->getUsuarioAll();
            $this->view("newmemorandum",array(
                "remitente" => $funcionarios,
                "destino"   => $funcionarios,
                "cite"  => $cite,
                "title"     => "Nuevo Memorandum"
            ));
        } else {
            //agregar codigo para enviar el mensaje de error
            $this->redirect("bandejas", "salida");
        }
    }

    public function editmemorandum(){
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
            
            $documentoId->fechahora = $fec->cambiaf_a_normal($documentoId->fechahora);
            $this->view("editmemorandum",array(
                'documento'=>$documentoId,
                'funcionarios' => $funcionarios,
                'title'    =>"Editar Memorandum"
            ));                    
        } else {
            $this->view('bandejas', 'salida');
        }
    }

    /**
    * Descripión: Crea el resgisto de un documento
    **/
    public function crearmemorandum(){
        if(isset($_POST["guardar"])){
            // verificar si existe el cargo
            $carta = new Documento();
            
            $fec = new Helpers();

            $carta->setIdtipodocumento(5);
            $carta->setIdformato(5);
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
            $carta->setNrofolios(null);
            $carta->setEstado(1);
            $save=$carta->save();
            
            $cite = new Cite();
            $idCite = $cite->getCiteIncrementContador($_SESSION['id']);
//            print_r($idCite);
//            echo 'asdfadf';
//            exit();
            $cite->updateContadorCite($idCite);
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
        }
        $this->redirect("bandejas", "salida");
    }

        /**
    * Descripión: Crea el resgisto de un documento
    **/
    public function editarmemorandum(){
        if(isset($_POST["guardar"])){
            // verificar si existe el cargo
            $carta = new Documento();
            
            $fec = new Helpers();

            $carta->setId((int)$_POST['id']);
            $carta->setIdtipodocumento(5);
            $carta->setIdformato(5);
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
            $carta->setNrofolios(null);
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
            "title"    =>"Badeja Salida"
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
    
    public function printcarta(){
        $doc = new Documento();

        $documento = new Documento();
        
        $fec = new Helpers();
        
        //verificamos el id del documento
        if(isset($_GET['id']) && $_GET['id'] > 0 && is_int((int)$_GET['id'])){
            //obtenemos los datos del documentos elegido
            $documentoId = $documento->getById($_GET['id']);
            
            //Obteniendo los remitentes
            $documentoId->remitente = $documento->getRemitente($_GET['id']);
            
            //Obteniendo los destinatarios
            $documentoId->destinatario = $documento->getDestinatario($_GET['id']);
            
//            echo '<pre>'; print_r($documentoId->destinatario); exit();
            //Obteniendo los concopia
            $documentoId->concopia = $documento->getConcopia($_GET['id']);
            
            $documentoId->fechahora = $fec->cambiaf_a_normal($documentoId->fechahora);
            
            if(is_array($documentoId->destinatario)){
                
                if(count($documentoId->destinatario) > 1) {
                    $denom = 'Señores:';
                } else if (count($documentoId->destinatario) == 1) {
                    $denom = 'Señor(a):';
                } else {
                    $denom = 'Señor(a):';
                }
            } else {
                $denom = 'Señores:';
            }
            //Creando la carta
            $pdf = new pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'Letter', true, 'UTF-8', false);
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('wHIlaquita');
            $pdf->SetTitle('Documento de Carta');
            $pdf->SetSubject('Ejemplo');
            $pdf->SetKeywords('SSEGUI, PDF, carta');
            
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(true);

            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(25, PDF_MARGIN_TOP, 20);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

            $pdf->SetFont('helvetica', '', 10);
            $pdf->AddPage();

            $html = '<div align="right">'.$documentoId->lugar.', '.$fec->fechaALetras($documentoId->fechahora).'<br><b>'.$documentoId->cite.'</b></br></div>';
            $html .= '<p></p><p>'.$denom.'</p>';
            
            
            if(is_array($documentoId->destinatario)){
                foreach ($documentoId->destinatario as $doc){
                     $html .= '<p>'.$doc->nombres.', '.$doc->apellidos .'<br><b>'. strtoupper($doc->cargo).'</b></p>';
                }
            } else {
                $html .= '<p><b>TODO EL PERSONAL</b></p>';
            }
            $html .= '<p><b>REF.:<u>'.$documentoId->referencia.'</u></b></p>';
            $html .= '<p>'.$documentoId->tenor.'</p>';
            $pdf->writeHTML($html,true, false, true, false, '');
            $pdf->lastPage();
            ob_end_clean();
            $pdf->Output('carta.pdf','I');
        } else {
            $this->view('bandejas', 'salida');
        }        
    }

    public function printinforme(){
        $doc = new Documento();

        $documento = new Documento();
        
        $fec = new Helpers();
        
        //verificamos el id del documento
        if(isset($_GET['id']) && $_GET['id'] > 0 && is_int((int)$_GET['id'])){
            //obtenemos los datos del documentos elegido
            $documentoId = $documento->getById($_GET['id']);
            
            //Obteniendo los remitentes
            $documentoId->remitente = $documento->getRemitente($_GET['id']);
            
            //Obteniendo los destinatarios
            $documentoId->destinatario = $documento->getDestinatario($_GET['id']);
            
//            echo '<pre>'; print_r($documentoId->destinatario); exit();
            //Obteniendo los concopia
            $documentoId->concopia = $documento->getConcopia($_GET['id']);
            
            $documentoId->fechahora = $fec->cambiaf_a_normal($documentoId->fechahora);
            
            if(is_array($documentoId->destinatario)){
                
                if(count($documentoId->destinatario) > 1) {
                    $denom = 'Señores:';
                } else if (count($documentoId->destinatario) == 1) {
                    $denom = 'Señor(a):';
                } else {
                    $denom = 'Señor(a):';
                }
            } else {
                $denom = 'Señores:';
            }
            //Creando la carta
            $pdf = new pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'Letter', true, 'UTF-8', false);
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('wHIlaquita');
            $pdf->SetTitle('Documento Informe');
            $pdf->SetSubject('Ejemplo');
            $pdf->SetKeywords('SSEGUI, PDF, carta');
            
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(true);

            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(25, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

            $pdf->SetFont('helvetica', '', 10);
            $pdf->AddPage();

            $html = '<div align="center"><b>I N F O R M E</b></div><hr>';
            $html .= '<div align="center"><b>'.$documentoId->cite.'</b></div>';
            $html .= '<table align="center" width = "70%">';
            $html .= '<tr><th width="50%" align="rigth">DE</th><td width="15">:</td><td width="50%" align="left">';
            if(is_array($documentoId->remitente)){
                foreach ($documentoId->remitente as $doc){
                     $html .= '<p>'.$doc->nombres.', '.$doc->apellidos .'<br><b>'. strtoupper($doc->cargo).'</b></p>';
                }
            } else {
                $html .= 'SIN REMITENTE';
            }
            $html .= '</td></tr>';
            $html .= '<tr><th width="50%" align="rigth">A</th><td>:</td><td width="50%" align="left">';
            if(is_array($documentoId->destinatario)){
                foreach ($documentoId->destinatario as $doc){
                     $html .= '<p>'.$doc->nombres.', '.$doc->apellidos .'<br><b>'. strtoupper($doc->cargo).'</b></p>';
                }
            } else {
                $html .= 'TODO EL PERSONAL';
            }
            $html .= '</td></tr>';
            $html .= '<tr><th width="50%" align="rigth">FECHA</th><td>:</td><td width="50%" align="left">'.$documentoId->lugar.', '.$fec->fechaALetras($documentoId->fechahora).'</td></tr>';
            $html .= '<tr><th width="50%" align="rigth">REFERENCIA</th><td>:</td><td width="50%" align="left">'.$documentoId->referencia.'</td></tr>';
            $html .= '</table><hr>';
            $html .= '<p>'.$documentoId->tenor.'</p>';
            $pdf->writeHTML($html,true, false, true, false, '');
            $pdf->lastPage();
            ob_end_clean();
            $pdf->Output('informe.pdf','I');
        } else {
            $this->view('bandejas', 'salida');
        }        
    }

    public function printcomunicado(){
        $doc = new Documento();

        $documento = new Documento();
        
        $fec = new Helpers();
        
        //verificamos el id del documento
        if(isset($_GET['id']) && $_GET['id'] > 0 && is_int((int)$_GET['id'])){
            //obtenemos los datos del documentos elegido
            $documentoId = $documento->getById($_GET['id']);
            
            //Obteniendo los remitentes
            $documentoId->remitente = $documento->getRemitente($_GET['id']);
            
            //Creando la carta
            $pdf = new pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'Letter', true, 'UTF-8', false);
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('wHIlaquita');
            $pdf->SetTitle('Documento Comunicado');
            $pdf->SetSubject('Ejemplo');
            $pdf->SetKeywords('SSEGUI, PDF, carta');
            
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(true);

            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(25, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

            $pdf->SetFont('helvetica', '', 10);
            $pdf->AddPage();

            $html = '<div align="center"><b>C O M U N I C A D O</b></div><hr>';
            $html .= '<div align="center"><b>'.$documentoId->cite.'</b></div>';
            $html .= '<p></p>';
            $html .= '<p>'.$documentoId->tenor.'</p>';
            $pdf->writeHTML($html,true, false, true, false, '');
            $pdf->lastPage();
            ob_end_clean();
            $pdf->Output('comunicado.pdf','I');
        } else {
            $this->view('bandejas', 'salida');
        }        
    }    

    public function printcircular(){
        $doc = new Documento();

        $documento = new Documento();
        
        $fec = new Helpers();
        
        //verificamos el id del documento
        if(isset($_GET['id']) && $_GET['id'] > 0 && is_int((int)$_GET['id'])){
            //obtenemos los datos del documentos elegido
            $documentoId = $documento->getById($_GET['id']);
            
            //Obteniendo los remitentes
            $documentoId->remitente = $documento->getRemitente($_GET['id']);
            
            //Obteniendo los destinatarios
            $documentoId->destinatario = $documento->getDestinatario($_GET['id']);
            
//            echo '<pre>'; print_r($documentoId->destinatario); exit();
            //Obteniendo los concopia
            $documentoId->concopia = $documento->getConcopia($_GET['id']);
            
            $documentoId->fechahora = $fec->cambiaf_a_normal($documentoId->fechahora);
            
            if(is_array($documentoId->destinatario)){
                
                if(count($documentoId->destinatario) > 1) {
                    $denom = 'Señores:';
                } else if (count($documentoId->destinatario) == 1) {
                    $denom = 'Señor(a):';
                } else {
                    $denom = 'Señor(a):';
                }
            } else {
                $denom = 'Señores:';
            }
            //Creando la carta
            $pdf = new pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'Letter', true, 'UTF-8', false);
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('wHilaquita');
            $pdf->SetTitle('Documento Circular');
            $pdf->SetSubject('Ejemplo');
            $pdf->SetKeywords('SSEGUI, PDF, carta');
            
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(true);

            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(25, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

            $pdf->SetFont('helvetica', '', 10);
            $pdf->AddPage();

            $html = '<div align="center"><b>C I R C U L A R</b></div><hr>';
            $html .= '<div align="center"><b>'.$documentoId->cite.'</b></div>';
            $html .= '<table align="center" width = "70%">';
            $html .= '<tr><th width="50%" align="rigth">DE</th><td width="15">:</td><td width="50%" align="left">';
            if(is_array($documentoId->remitente)){
                foreach ($documentoId->remitente as $doc){
                     $html .= '<p>'.$doc->nombres.', '.$doc->apellidos .'<br><b>'. strtoupper($doc->cargo).'</b></p>';
                }
            } else {
                $html .= 'SIN REMITENTE';
            }
            $html .= '</td></tr>';
            $html .= '<tr><th width="50%" align="rigth">A</th><td>:</td><td width="50%" align="left">TODO EL PERSONAL</td></tr>';
            $html .= '<tr><th width="50%" align="rigth">FECHA</th><td>:</td><td width="50%" align="left">'.$documentoId->lugar.', '.$fec->fechaALetras($documentoId->fechahora).'</td></tr>';
            $html .= '<tr><th width="50%" align="rigth">REFERENCIA</th><td>:</td><td width="50%" align="left">'.$documentoId->referencia.'</td></tr>';
            $html .= '</table><hr>';
            $html .= '<p>'.$documentoId->tenor.'</p>';
            $pdf->writeHTML($html,true, false, true, false, '');
            $pdf->lastPage();
            ob_end_clean();
            $pdf->Output('circular.pdf','I');
        } else {
            $this->view('bandejas', 'salida');
        }        
    }
    
    public function printmemorandum(){
        $doc = new Documento();

        $documento = new Documento();
        
        $fec = new Helpers();
        
        //verificamos el id del documento
        if(isset($_GET['id']) && $_GET['id'] > 0 && is_int((int)$_GET['id'])){
            //obtenemos los datos del documentos elegido
            $documentoId = $documento->getById($_GET['id']);
            
            //Obteniendo los remitentes
            $documentoId->remitente = $documento->getRemitente($_GET['id']);
            
            //Obteniendo los destinatarios
            $documentoId->destinatario = $documento->getDestinatario($_GET['id']);
            
//            echo '<pre>'; print_r($documentoId->destinatario); exit();
            //Obteniendo los concopia
            $documentoId->concopia = $documento->getConcopia($_GET['id']);
            
            $documentoId->fechahora = $fec->cambiaf_a_normal($documentoId->fechahora);
            
            if(is_array($documentoId->destinatario)){
                
                if(count($documentoId->destinatario) > 1) {
                    $denom = 'Señores:';
                } else if (count($documentoId->destinatario) == 1) {
                    $denom = 'Señor(a):';
                } else {
                    $denom = 'Señor(a):';
                }
            } else {
                $denom = 'Señores:';
            }
            //Creando la carta
            $pdf = new pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'Letter', true, 'UTF-8', false);
            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('wHIlaquita');
            $pdf->SetTitle('Documento de Carta');
            $pdf->SetSubject('Ejemplo');
            $pdf->SetKeywords('SSEGUI, PDF, carta');
            
            $pdf->SetPrintHeader(false);
            $pdf->SetPrintFooter(true);

            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(25, PDF_MARGIN_TOP, 20);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

            $pdf->SetFont('helvetica', '', 10);
            $pdf->AddPage();

            $html = '<div align="center"><b>M E M O R A N D U M</b></div>';
            $html .= '<div align="left"><i>'.$documentoId->lugar.', '.$fec->fechaALetras($documentoId->fechahora).'</i><br><i><b>'.$documentoId->cite.'</b></i></br></div>';
            $html .= '<p></p><p><i>'.$denom.'</i></p>';
            
            
            if(is_array($documentoId->destinatario)){
                foreach ($documentoId->destinatario as $doc){
                     $html .= '<p><i>'.$doc->nombres.', '.$doc->apellidos .'<br><b>'. strtoupper($doc->cargo).'</i></b></p>';
                }
            } else {
                $html .= '<p><i><b>TODO EL PERSONAL</b></i></p>';
            }
            $html .= '<p><i><b>REF.:<u>'.$documentoId->referencia.'</u></b></i></p>';
            $html .= '<p><i>'.$documentoId->tenor.'</i></p>';
            $pdf->writeHTML($html,true, false, true, false, '');
            $pdf->lastPage();
            ob_end_clean();
            $pdf->Output('memorandum.pdf','I');
        } else {
            $this->view('bandejas', 'salida');
        }        
    }
    
}
?>
