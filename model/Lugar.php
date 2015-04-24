<?php

/**
 * Description of Lugar
 *
 * @author wilmer
 */
class Lugar extends EntidadBase {
    //put your code here

    private $id;
    private $lugar;
    private $estado;
    
    public function __construct() {
        $table="lugar";
        parent::__construct($table);
    }
    
    function getId() {
        return $this->id;
    }

    function getLugar() {
        return $this->lugar;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLugar($lugar) {
        $this->lugar = $lugar;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

}
