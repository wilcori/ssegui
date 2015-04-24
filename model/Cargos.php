<?php
class Cargos extends EntidadBase{
    private $id;
    private $cargo;
    private $descripcion;
    private $fregistro;
    private $tipocargo;
    private $estado;
    
    public function __construct() {
        $table="cargos";
        parent::__construct($table);
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getCargo() {
        return $this->cargo;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getFregistro() {
        return $this->fregistro;
    }

    public function setFregistro($fregistro) {
        $this->fregistro = $fregistro;
    }

    public function getTipocargo() {
        return $this->tipocargo;
    }

    public function setTipocargo($tipocargo) {
        $this->tipocargo = $tipocargo;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function save(){
        $query="INSERT INTO cargos (id,cargo,descripcion,fregistro,tipocargo,estado)
                VALUES(NULL,
                       '".$this->cargo."',
                       '".$this->descripcion."',
                       '".$this->fregistro."',
                       '".$this->tipocargo."',
                       '".$this->estado."');";
        // echo $query; exit();
        $save=$this->db()->query($query);

        // $this->db()->error;
        return $save;
    }
    
    public function update(){
        $query="UPDATE cargos SET 
                cargo = '".$this->cargo."',
                descripcion = '".$this->descripcion."',
                fregistro = '".$this->fregistro."',
                tipocargo = '".$this->tipocargo."',
                estado = '".$this->estado."'
                WHERE id = ".(int)$this->id.";";
//        echo $query; exit();
        $update = $this->db()->query($query);
        //$this->db()->error;
        return $update;
    }

    public function borrar(){
        
    }

    public function getCargoExistente($cargo){
        $query = "SELECT cargo FROM cargos WHERE cargo = '$cargo' AND estado = 1";
        $cargo = $this->ejecutarSql($query);
        // echo '<pre>';
        // print_r( $cargo->cargo); exit();
        return (isset($cargo->cargo)) ? true : false;
    }
}
?>