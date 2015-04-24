<?php
class Remitente extends EntidadBase{
    private $id;
    private $iddocumento;
    private $idactividadusuario;
    
    public function __construct() {
        $table="remitente";
        parent::__construct($table);
    }
    function getId() {
        return $this->id;
    }

    function getIddocumento() {
        return $this->iddocumento;
    }

    function getIdactividadusuario() {
        return $this->idactividadusuario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIddocumento($iddocumento) {
        $this->iddocumento = $iddocumento;
    }

    function setIdactividadusuario($idactividadusuario) {
        $this->idactividadusuario = $idactividadusuario;
    }

    public function save(){
        $query="INSERT INTO remitente 
                VALUES(NULL,
                       '".$this->iddocumento."',
                       '".$this->idactividadusuario."');";
        // echo $query; exit();
        $save=$this->db()->query($query);

        // $this->db()->error;
        return $save;
    }
    
}
?>