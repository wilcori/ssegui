<?php
/**
 * Description of Cite
 *
 * @author whilaquita
 */
class Cite extends EntidadBase{
    //put your code here
    private $id;
    private $idestructura;
    private $acronimo;
    private $contador;
    private $tipocreacion;
    private $estado;
    
    public function __construct() {
        $table="cite";
        parent::__construct($table);
    }

    function getId() {
        return $this->id;
    }

    function getIdestructura() {
        return $this->idestructura;
    }

    function getAcronimo() {
        return $this->acronimo;
    }

    function getContador() {
        return $this->contador;
    }

    function getTipocreacion() {
        return $this->tipocreacion;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdestructura($idestructura) {
        $this->idestructura = $idestructura;
    }

    function setAcronimo($acronimo) {
        $this->acronimo = $acronimo;
    }

    function setContador($contador) {
        $this->contador = $contador;
    }

    function setTipocreacion($tipocreacion) {
        $this->tipocreacion = $tipocreacion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getAcronimoAll(){
        $sql = 'SELECT c.id,e.nombre,c.acronimo,c.contador,c.tipocreacion,c.estado FROM cite c join estructura e on e.id = c.idestructura';
        $cite = $this->ejecutarSql($sql);
        return $cite;
    }
    
    public function save(){
        $query="INSERT INTO cite (id,idestructura,acronimo,contador,tipocreacion,estado)
                VALUES(NULL,
                       '".$this->idestructura."',
                       '".$this->acronimo."',
                       '".$this->contador."',
                       '".$this->tipocreacion."',
                       '".$this->estado."');";
        // echo $query; exit();
        $save=$this->db()->query($query);

        // $this->db()->error;
        return $save;
    }
    
    public function getCiteExistente($idestructura){
        $query = "select * from cite where idestructura = ".$idestructura." and estado = 1;";
//        echo $query; exit();
        $cite = $this->ejecutarSql($query);
//         echo '<pre>';
//         
//         print_r( $cite); exit();
        return (is_array($cite)) ? true : false;
    }    
    
    public function getCiteIncrementContador($id){
        $query = "select ct.id from actividadusuario au join antiguedad a on au.id = a.idactividadusuario 
            join estructura e on e.idforaneo = a.idestructura join cite ct on ct.idestructura = e.idforaneo
            where e.estado = 1 and a.estado = 1 and au.id = ".$id;
        
        $cite = $this->ejecutarSql($query);
        
        return $cite[0]->id;
    }
    
    public function updateContadorCite($id){
        $query = "UPDATE cite SET contador = contador + 1 WHERE id = ".$id." and estado = 1";
//        echo $query;
//        exit();
        $cite = $this->db()->query($query);
        return $cite;
    }
}
