<?php
/**
 * Description of Cite
 *
 * @author whilaquita
 */
class Cite  extends EntidadBase{
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
}
