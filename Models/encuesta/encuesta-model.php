<?php

include_once "Classes/MSGException.php";

class EncuestaModel {

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

    function getEncuesta($id) {
        try {
            //Encuesta
            $stmt = $this->dbh->prepare("SELECT * FROM ENCUESTA WHERE ID = :id");
            $stmt->bindParam(":id", $id);

            if(!$stmt->execute()) {throw new PDOException();}

            $encuesta = $stmt->fetch();
            $toReturn = new Encuesta($encuesta["ID"],$encuesta["NOMBRE"],$encuesta["PROPIETARIO"]);
            

            //Fechas
            $stmt = $this->dbh->prepare("SELECT * FROM FECHA WHERE IDENCUESTA = :id");
            $stmt->bindParam(":id", $id);

            if(!$stmt->execute()) {throw new PDOException();}

            $fechas = array();
            foreach($stmt->fetchAll() as $fecha) {
                //Por cada Fecha encontrada, añadir al array un nuevo objeto con los datos encontrados
                $fechas[] = new Fecha($fecha["FECHA"]);
            }


            //Horas
            $stmt = $this->dbh->prepare("SELECT * FROM HORA WHERE IDENCUESTA = :id");
            $stmt->bindParam(":id", $id);

            if(!$stmt->execute()) {throw new PDOException();}

            foreach($stmt->fetchAll() as $hora) {
                //Por cada Hora encontrada, añadir al array un nuevo objeto con los datos encontrados
                foreach($fechas as $fecha) {
                    if($fecha->getFecha() == $hora["FECHA"]) {
                        $fecha->horas[] = new Hora($hora["HORAINICIO"],$hora["HORAFIN"]);
                    }
                }
            }
            
            $toReturn->setFechas($fechas);

            return $toReturn;
        }
        catch (PDOException $e) {
            throw new MSGException("Error obteniendo los datos de la encuesta","danger");    
        }
    }

    function getVotosOnEncuesta($id) {
        try {

            $toReturn = array();

            $stmt = $this->dbh->prepare("SELECT * FROM VOTA WHERE IDENCUESTA = :id");
            $stmt->bindParam(":id", $id);

            if(!$stmt->execute()) {throw new PDOException();}

            foreach($stmt->fetchAll() as $voto) {
                $toReturn[] = new Voto($voto["CORREOUSUARIO"],$voto["IDENCUESTA"],$voto["FECHA"],$voto["HORAINICIO"],$voto["HORAFIN"]);
            }
            
            return $toReturn;
        }
        catch (PDOException $e) {
            throw new MSGException("Error obteniendo datos de los votos en la encuesta","danger");    
        }
    }
}

?>