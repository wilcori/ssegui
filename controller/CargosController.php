<?php
class CargosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        //Creamos el objeto usuario
        $usuario=new Cargos();
        
        //Conseguimos todos los usuarios
        $allusers=$usuario->getAll();
       
        //Cargamos la vista index y le pasamos valores
        $this->view("cargos",array(
            "allusers"=>$allusers,
            "title"    =>"SSEGUI - Cargos"
        ));
    }

    public function nuevo(){
        //Creamos el objeto usuario
        $this->view("cargosnuevo",array());
    }
    
    public function crear(){
        if(isset($_POST["cargo"])){
            // verificar si existe el cargo
            $usuario = new Cargos();
            if($usuario->getCargoExistente($_POST["cargo"])){
                $this->redirect("Cargos", "index");
            } else {
                // unset($verificaCargo);
                //Creamos un Cargo
                // $usuario=new Cargos();
                $usuario->setCargo($_POST["cargo"]);
                $usuario->setDescripcion($_POST["descripcion"]);
                $usuario->setFregistro(date('Y-m-d'));
                $usuario->setTipocargo($_POST["tcargo"]);
                $usuario->setEstado($_POST["estado"]);
                $save=$usuario->save();
            }
        }
        $this->redirect("Cargos", "index");
    }

    public function update(){
        if(isset($_POST['id']) && $_POST['id'] > 0){
            //verificar si existe el cargo
            $cargo = new Cargos();
            if($cargo->getCargoExistente($_POST["cargo"])){
                $this->redirect("Cargos", "index");
            } else {
                //Creamos un Cargo
                // $usuario = new Cargos();
                $cargo->setId($_POST['id']);
                $cargo->setCargo($_POST["cargo"]);
                $cargo->setDescripcion($_POST["descripcion"]);
                // $usuario->setFregistro(date('Y-m-d'));
                $cargo->setTipocargo($_POST["tcargo"]);
                $cargo->setEstado($_POST["estado"]);
                $update = $cargo->update();
            }
        }
        $this->redirect("Cargos", "index");
    }

    public function editar(){
        $usuario = new Cargos();
        //Conseguimos todos los usuarios
        $allusers=$usuario->getById($_GET['id']);
        //Cargamos la vista index y le pasamos valores
        $this->view("cargosedit",array(
            "allusers"=>$allusers,
            "title"    =>"SSEGUI - Editar Cargo"
        ));        
    }

    public function guardarEditar(){
        $usuario = new UsuariosModel();
        if(isset($_POST['id']) && $_POST['id'] > 0){

            $datosUser = array(
                "id"=>$_POST['id'],
                "nombres"=>$_POST['nombres'],
                "apellidos"=>$_POST['apellidos'],
                "ci"=>$_POST['ci'],
                "extension"=>$_POST['extension'],
                "fnacimiento"=>$_POST['fnacimiento']
                );
            $update = $usuario->update($datosUser);
        }
        $this->redirect("Usuarios",'index');
    }
    
    public function borrar(){
        if(isset($_GET["id"])){ 
            $id=(int)$_GET["id"];
            
            $usuario=new Cargos();
            $usuario->deleteById($id); 
        }
        $this->redirect();
    }
    
    public function validar(){
        if ( isset( $_POST['email']) || isset( $_POST['pass']) || isset($_POST['ingresar']) ){
            $usuario = new UsuariosModel();
            $usuarioAdmitido = $usuario->getUsuarioAdmitido($_POST['email'], sha1($_POST['pass']));
            if($usuarioAdmitido == true){
                $this->redirect("Usuarios", "index");
            } else {
                $this->redirect("Usuarios", "viewLogin");
            }

        }
    }

    public function viewLogin(){
        $this->view("login",array());
    }
    
    public function hola(){
        $usuarios=new UsuariosModel();
        $usu=$usuarios->getUnUsuario();
        var_dump($usu);
    }

}
?>
