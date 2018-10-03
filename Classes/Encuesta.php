<?php
class Encuesta {

    //Privado porque no se deben cambiar nunca desde fuera
    private $ID;
    private $nombre;
    private $propietario;

    public $fechas; //Array de objetos Fecha

    function __construct($id, $n, $p) {
        $this->ID = $id;
        $this->nombre = $n;
        $this->propietario = $p;
    }

    function getID() {
        return $this->ID;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPropietario() {
        return $this->propietario;
    }

}
?>