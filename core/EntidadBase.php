<?php
class EntidadBase{
    private $table;
    private $db;
    private $conectar;

    public function __construct($table) {
        $this->table=(string) $table;
        require_once 'Conectar.php';
        $this->conectar=new Conectar();
        $this->db = $this->conectar->conexion();
    }
    
    public function getConetar(){
        return $this->conectar;
    }
    
    public function db(){
        return $this->db;
    }
    
    public function getAll(){
        $query=$this->db->query("SELECT * FROM $this->table ORDER BY id DESC");

        while ($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }
    
    public function getById($id){
        $query=$this->db->query("SELECT * FROM $this->table WHERE id=$id");

        if($row = $query->fetch_object()) {
           $resultSet=$row;
        }
        
        return $resultSet;
    }
    
    public function getBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value'");

        while($row = $query->fetch_object()) {
           $resultSet[]=$row;
        }
        
        return $resultSet;
    }
    
    public function deleteById($id){
        $query=$this->db->query("DELETE FROM $this->table WHERE id=$id"); 
        return $query;
    }
    
    public function deleteBy($column,$value){
        $query=$this->db->query("DELETE FROM $this->table WHERE $column='$value'"); 
        return $query;
    }
    
    public function ejecutarSql($query){
        $query=$this->db()->query($query);
        if($query==true){
            if($query->num_rows>0){
                while($row = $query->fetch_object()) {
                   $resultSet[]=$row;
                }
                // echo 'paso por aqui';
//            }elseif($query->num_rows==1){
//                if($row = $query->fetch_object()) {
//                    $resultSet=$row;
//                }
//                // echo 'paso por aqui';
            }else{
                $resultSet=false;
            }
        }else{
            $resultSet=false;
        }
        
        return $resultSet;
    }

    public function sqlRecurso($query){
        $query=$this->db()->query($query);
        if($query==true){
            $c = 0;
            if($query->num_rows>1){
                while($row = $query->fetch_row()) {
                   $resultSet[$c]['id']=$row[0];
                   $resultSet[$c]['idrecurso']=$row[4];
                   $resultSet[$c]['etiqueta']=$row[3];
                   $resultSet[$c]['controller']=$row[1];
                   $resultSet[$c]['action']=$row[2];
                   $resultSet[$c]['link']=$row[6];
                   $resultSet[$c]['order']=$row[5];
                   $c++;
                }
                // echo 'paso por aqui';
            }elseif($query->num_rows==1){
                if($row = $query->fetch_row()) {
//                    $resultSet=$row;
                   $resultSet[$c]['id']=$row[0];
                   $resultSet[$c]['idrecurso']=$row[4];
                   $resultSet[$c]['etiqueta']=$row[3];
                   $resultSet[$c]['controller']=$row[1];
                   $resultSet[$c]['action']=$row[2];
                   $resultSet[$c]['link']=$row[7];
                   $resultSet[$c]['order']=$row[5];
//                   $c++;
                    
                }
                // echo 'paso por aqui';
            }else{
                $resultSet=true;
            }
        }else{
            $resultSet=false;
        }
        
        return $resultSet;
    }

    /*
     * Aqui podemos montarnos un monton de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */
    
}
?>
