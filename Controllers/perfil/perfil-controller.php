<?php

include_once "Views/msg-view.php";
include_once "Views/perfil/perfil-view.php";
include_once "Models/perfil/perfil-model.php";
include_once "Classes/Encuesta.php";
include_once "Classes/MSGException.php";

class PerfilController {

    function __construct() {
        if(isset($_POST["action"])) {
            //Si vienen acciones por POST (Inserciones, modificaciones y borrados en la BD)
            try {
                $perfilModel = new PerfilModel();

                switch($_POST["action"]) {
                    case "nuevaEncuesta":
                        if(isset($_POST["nombre"]))
                        {
                        //Añadir nueva encuesta en la BD
                        $id = $perfilModel->nuevaEncuesta($_POST["nombre"],$_SESSION["email"]); //Usar NOMBRE del POST y PROPIETARIO de SESSION

                        //Redirigir al controlador de ENCUESTAS con accion de EDITAR la encuesta generada
                        header("Location: /index.php?controller=encuesta&action=editencuesta&id=".$id);
                        }
                        else
                        {

                            header("Location: /index.php?controller=perfil"); 

                        }
                        break;

                    case "delEncuesta":
                    
                        if(isset($_POST["id"]))
                        {
                        //Comprobar si el usuario es propietario de la encuesta
                        if($perfilModel->getPropietarioEncuesta($_POST["id"]) == $_SESSION["email"]) {
                            //Borrar encuesta de la BD
                            $perfilModel->delEncuesta($_POST["id"]);
                            MSGException::setTemporalMessage(new MSGException("Encuesta eliminada con éxito","success"));
                        }
                        else {
                            throw new MSGException("La encuesta a eliminar no pertenece al usuario","warning");
                        }
                        }

                        //Redirigir al controlador de PERFIL para mostrar mensaje confirmando
                        header("Location: /index.php?controller=perfil"); //Redirigir al perfil con la accion por GET
                        break;

                }
            } catch(MSGException $e) {
                MSGException::setTemporalMessage($e); //Añadir mensaje temporal de error
                header("Location: /index.php?controller=perfil"); //Redirigir al controller sin accion
            }
        }
        else if(isset($_GET["action"])) {
            //Si vienen acciones por GET
            switch($_GET["action"]) {           
                case "logout":
                    //Se pone esto en el perfil porque un usuario logeado no puede acceder al controller de login
                    session_destroy();
                    header('Location: /index.php');
					break;
            }
        }
         
        //SHOWALL

        //Obtener encuestas de la BD con el modelo del perfil
        try {
            $perfilModel = new PerfilModel();
            $arrEncuestas = $perfilModel->getEncuestas($_SESSION["email"]);

            if(!isset($arrEncuestas["encuestas"])) {$arrEncuestas["encuestas"] = array();}
            if(!isset($arrEncuestas["encuestasCompartidas"])) {$arrEncuestas["encuestasCompartidas"] = array();}
            //Mostrar vista con las encuestas sacadas de la BD
            (new PerfilView($arrEncuestas["encuestas"],$arrEncuestas["encuestasCompartidas"],MSGException::getTemporalMessage()))->render();
        } catch (MSGException $e) {
            MSGException::setTemporalMessage($e); //Añadir mensaje temporal de error
            (new MSGView($e,true))->render();
        }

    }
}
        ?>