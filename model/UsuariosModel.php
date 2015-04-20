<?php
class UsuariosModel extends ModeloBase{
    private $table;
    
    public function __construct(){
        $this->table="usuarios";
        parent::__construct($this->table);
    }
    
    /**
    * Obtiene un usuario 
    **/
    public function getUnUsuario($id){
        $query="SELECT au.id, au.email, a.fechainicial, a.fechafinal, u.fnacimiento, u.nombres,u.apellidos, u.ci,u.extension 
                FROM actividadusuario au JOIN antiguedad a ON (au.id = a.idactividadusuario) JOIN usuarios u ON (au.idusuarios = u.id)
                WHERE au.estado = 1 and au.id = $id";
        $usuario=$this->ejecutarSql($query);
        return $usuario;
    }
    //Obtener un usuario admitido
    public function getUsuarioAdmitido($user,$password){
        $query="SELECT * FROM actividadusuario WHERE email='$user' AND password = '$password'";

        $usuario=$this->ejecutarSql($query);
        if(isset($usuario->email)){
            $_SESSION['email'] = $usuario->email;
            $_SESSION['id'] = $usuario->id;
            return true;
        } else {
            return false;
        }
    }
    //Obtener un usuario 
    public function getAllUsers(){
        $query="SELECT au.id, au.email, u.nombres,u.apellidos, concat(u.ci,u.extension) ci 
                FROM actividadusuario au JOIN usuarios u ON (au.idusuarios = u.id)
                WHERE au.estado = 1";
        $usuario=$this->ejecutarSql($query);
        // echo '<pre>';
        // print_r($usuario);
        // echo '</pre>';
        return $usuario;
    }

    public function update($datos){
        $query="UPDATE actividadusuario au 
        JOIN antiguedad a ON (au.idantiguedad = a.id) 
        JOIN usuarios u ON (a.idusuarios = u.id) SET 
            u.nombres = '".$datos['nombres']."',
            u.apellidos = '".$datos['apellidos']."',
            u.ci = '".$datos['ci']."',
            u.extension = '".$datos['extension']."',
            u.fnacimiento = '".$datos['fnacimiento']."'
        WHERE au.id = ".$datos['id'];
        $update=$this->db()->query($query);
        return $update;
    }

}
?>