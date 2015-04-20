<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Recurso
 *
 * @author wilmer
 */
class Recurso extends EntidadBase{
    private $id;
    private $controlador;
    private $accion;
    private $etiqueta;
    private $idrecurso;
    private $orden;
    private $fregistro;
    private $link;

    public function __construct() {
        $table="recurso";
        parent::__construct($table);
    }
    

    function getId() {
        return $this->id;
    }

    function getControlador() {
        return $this->controlador;
    }

    function getAccion() {
        return $this->accion;
    }

    function getEtiqueta() {
        return $this->etiqueta;
    }

    function getIdrecurso() {
        return $this->idrecurso;
    }

    function getOrden() {
        return $this->orden;
    }

    function getFregistro() {
        return $this->fregistro;
    }

    function getLink() {
        return $this->link;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setControlador($controlador) {
        $this->controlador = $controlador;
    }

    function setAccion($accion) {
        $this->accion = $accion;
    }

    function setEtiqueta($etiqueta) {
        $this->etiqueta = $etiqueta;
    }

    function setIdrecurso($idrecurso) {
        $this->idrecurso = $idrecurso;
    }

    function setOrden($orden) {
        $this->orden = $orden;
    }

    function setFregistro($fregistro) {
        $this->fregistro = $fregistro;
    }

    function setLink($link) {
        $this->link = $link;
    }

    function getRecurso(){
        $query = "SELECT id,controlador,accion, etiqueta, idrecurso, orden fregistro, link FROM recurso ORDER BY orden ASC";
        $recurso = $this->sqlRecurso($query);
        return $recurso;
    }

}
