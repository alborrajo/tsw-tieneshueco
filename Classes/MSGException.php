<?php
class MSGException extends Exception {

    /*
    Status: Cambia el color de la alerta (Bootstrap)
        primary     -   Azul
        secondary   -   Gris
        success     -   Verde
        danger      -   Rojo
        warning     -   Amarillo
        info        -   Azul claro
        light       -   Blanco
        dark        -   Gris otra vez
    */
    private $status;

    public function __construct($message, $status) {
        parent::__construct($message);
        $this->status = $status;        
    }

    public function getStatus() {
        return $this->status;
    }
}
?>