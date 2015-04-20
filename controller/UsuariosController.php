<?php
class UsuariosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        
        //Creamos el objeto usuario
        $usuario=new UsuariosModel();
        
        //Conseguimos todos los usuarios
        $allusers=$usuario->getAllUsers();
       
        //Cargamos la vista index y le pasamos valores
        $this->view("usuarios",array(
            "allusers"=>$allusers,
            "Hola"    =>"Soy Víctor Robles"
        ));
    }
    
    public function crear(){
        if(isset($_POST["nombre"])){
            //Creamos un usuario
            $usuario=new Usuario();
            $usuario->setNombre($_POST["nombre"]);
            $usuario->setApellido($_POST["apellido"]);
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword(sha1($_POST["password"]));
            $save=$usuario->save();
        }
        $this->redirect("Usuarios", "index");
    }

    public function editar(){
        $usuario = new UsuariosModel();
        if(isset($_GET['id']) && $_GET['id'] > 0 && is_int((int)$_GET['id'])){
            $usuarios = $usuario->getUnUsuario($_GET['id']);
            $this->view("usuariosedit",array("allusers"=>$usuarios));
        } else {
            $this->redirect("Usuarios",'index');
        }
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

            // $usuario->setNombres($_POST['nombres']);
            // $usuario->setApellidos($_POST['apellidos']);
            // $usuario->setCi($_POST['ci']);
            // $usuario->setExtension($_POST['extension']);
            // $usuario->setFnacimiento($_POST['fnacimiento']);

            $update = $usuario->update($datosUser);
        }
        $this->redirect("Usuarios",'index');
    }
    
    public function borrar(){
        if(isset($_GET["id"])){ 
            $id=(int)$_GET["id"];
            
            $usuario=new Usuario();
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
