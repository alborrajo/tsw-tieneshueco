<?php

include_once "Classes/MSGException.php";

class PerfilModel {

    private $dbh;

    function __construct() {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=TIENESHUECO', "tieneshueco", "tieneshueco");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            //Si no se hace así, se mostrarían todos los datos de la conexión, INCLUYENDO USER Y PASS DE LA BD
            throw new MSGException("Error conectando con la BD","danger");
        }
    }


    //Retorna el ID de la encuesta insertada
    //Tira MSGException si falla
    function nuevaEncuesta($nombre, $propietario) {
        try {
            $id = md5(uniqid($_SESSION["email"], true));

            $stmt = $this->dbh->prepare("INSERT INTO ENCUESTA (ID, NOMBRE, PROPIETARIO) VALUES (:id, :nombre, :value)");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":propietario", $propietario);

            if(!$stmt->execute()) {throw new PDOException();}

            return $id;
        }
        catch (PDOException $e) {
            throw new MSGException("Error añadiendo la nueva encuesta","danger");    
        }
    }


    //Retorna EMAIL del propietario de la encuesta ID
    //Tira MSGException si falla
    function getPropietarioEncuesta($id) {
        try {
            $stmt = $this->dbh->prepare("SELECT PROPIETARIO FROM ENCUESTA WHERE ID = :id");
            $stmt->bindParam(":id", $id);

            if(!$stmt->execute()) {throw new PDOException();}

            return $stmt->fetch()["PROPIETARIO"];
        }
        catch (PDOException $e) {
            throw new MSGException("Error obteniendo datos sobre la encuesta","danger");    
        }
    }


    //Tira MSGException si falla
    function delEncuesta($id) {
        try {
            $id = md5(uniqid($_SESSION["email"], true));

            $stmt = $this->dbh->prepare("DELETE FROM ENCUESTA WHERE ID = :id");
            $stmt->bindParam(":id", $id);

            if(!$stmt->execute()) {throw new PDOException();}
        }
        catch (PDOException $e) {
            throw new MSGException("Error eliminando encuesta","danger");    
        }
    }


    function getEncuestas($email) {
        try {
            $toReturn = array();

            //Encuestas propias
            $stmt = $this->dbh->prepare("SELECT * FROM ENCUESTA WHERE PROPIETARIO = :email");
            $stmt->bindParam(":email", $email);

            if(!$stmt->execute()) {throw new PDOException();}

            $toReturn["encuestas"] = $stmt->fetch();

            //Encuestas compartidas
            $stmt = $this->dbh->prepare("SELECT e.* FROM ENCUESTA e, VOTA v WHERE CORREOUSUARIO = :email AND ID = IDENCUESTA");
            $stmt->bindParam(":email", $email);

            if(!$stmt->execute()) {throw new PDOException();}

            $toReturn["encuestasCompartidas"] = $stmt->fetch();
        }
        catch (PDOException $e) {
            throw new MSGException("Error obteniendo datos de las encuestas del usuario","danger");    
        }
    }

}
?>