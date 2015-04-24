<?php

/**
 * Description of Estructura
 *
 * @author whilaquita
 */
class Estructura extends EntidadBase{
    
    private $id;
    private $idforaneo;
    private $nombre;
    private $idestructura;
    private $descripcion;
    private $acronimo;
    private $fregistro;
    private $estado;
    
    public function __construct() {
        $table="estructura";
        parent::__construct($table);
    }
    
    function getId() {
        return $this->id;
    }

    function getIdforaneo() {
        return $this->idforaneo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getIdestructura() {
        return $this->idestructura;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getAcronimo() {
        return $this->acronimo;
    }

    function getFregistro() {
        return $this->fregistro;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdforaneo($idforaneo) {
        $this->idforaneo = $idforaneo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setIdestructura($idestructura) {
        $this->idestructura = $idestructura;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setAcronimo($acronimo) {
        $this->acronimo = $acronimo;
    }

    function setFregistro($fregistro) {
        $this->fregistro = $fregistro;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    
}
