<?php

include_once "Classes/MSGException.php";

class EncuestaModel {

    private $dbh;

    function __construct() {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=tieneshueco', "tieneshueco", "tieneshueco");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            //Si no se hace así, se mostrarían todos los datos de la conexión, INCLUYENDO USER Y PASS DE LA BD
            throw new MSGException("Error conectando con la BD","danger");
        }
    }
}

?>