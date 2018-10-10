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
                        //Añadir nueva encuesta en la BD
                        $id = $perfilModel->nuevaEncuesta($_POST["nombre"],$_SESSION["email"]); //Usar NOMBRE del POST y PROPIETARIO de SESSION

                        //Redirigir al controlador de ENCUESTAS con accion de EDITAR la encuesta generada
                        header("Location: /index.php?controller=encuesta&action=editencuesta&id=".$id);
                        break;

                    case "delEncuesta":
                        //Comprobar si el usuario es propietario de la encuesta
                        if($perfilModel->getPropietarioEncuesta($_POST["id"]) == $_SESSION["email"]) {
                            //Borrar encuesta de la BD
                            $perfilModel->delEncuesta($_POST["id"]);
                        }                        

                        //Redirigir al controlador de ENCUESTAS con accion de EDITAR la encuesta generada
                        header("Location: /index.php?controller=perfil&action=delEncuesta"); //Redirigir al perfil con la accion por GET
                        break;

                }
            } catch(MSGException $e) {
                (new MSGView($e))->render();
            }
        }
        else if(isset($_GET["action"])) {
            //Si vienen acciones por GET (Consultas en la BD)
            switch($_GET["action"]) {
                case "delEncuesta":
                    //Mostrar perfil con mensaje de encuesta borrada

                    //TODO: Sacar encuestas de la BD con el modelo del perfil
                    //Codigo TEMPORAL para tener datos de prueba
                    $encuestas = array(
                        new Encuesta("20d59b95948b67ce4cadaac4f7934b1a","Reunión","propie@tar.io"),
                        new Encuesta("ee057c31ff0e9d301189cfbbaea44c3f","Quedada youtuber para darse patadas voladoras","propie@tar.io")
                    );
                    $encuestasCompartidas = array(
                        new Encuesta("71ce30c162e84936de7584ed3c384b5b","Prueba","otropropie@tar.io"),
                        new Encuesta("01b3f378798d72bf73c8050d76707e0a","Cumpleaños","otropropie@tar.io"),
                        new Encuesta("d8c30b0993a4029a9f307767b3f2436e","Fleenstones!?","grand@dad.com"),
                        new Encuesta("1bc29b36f623ba82aaf6724fd3b16718","md5","md5@md5.md5")
                    );

                    //Mostrar vista con las encuestas sacadas de la BD
                    (new PerfilView($encuestas,$encuestasCompartidas,"Encuesta borrada"))->render();
                    break;
                
                case "logout":
                    //Se pone esto en el perfil porque un usuario logeado no puede acceder al controller de login
                    session_destroy();
                    header('Location: /index.php');
					break;
            }
        }
        else {            
            //Si no vienen acciones, SHOWALL

            //TODO: Sacar encuestas de la BD con el modelo del perfil
            //Codigo TEMPORAL para tener datos de prueba
            $encuestas = array(
                new Encuesta("20d59b95948b67ce4cadaac4f7934b1a","Reunión","propie@tar.io"),
                new Encuesta("ee057c31ff0e9d301189cfbbaea44c3f","Quedada youtuber para darse patadas voladoras","propie@tar.io")
            );
            $encuestasCompartidas = array(
                new Encuesta("71ce30c162e84936de7584ed3c384b5b","Prueba","otropropie@tar.io"),
                new Encuesta("01b3f378798d72bf73c8050d76707e0a","Cumpleaños","otropropie@tar.io"),
                new Encuesta("d8c30b0993a4029a9f307767b3f2436e","Fleenstones!?","grand@dad.com"),
                new Encuesta("1bc29b36f623ba82aaf6724fd3b16718","md5","md5@md5.md5")
            );

            //Mostrar vista con las encuestas sacadas de la BD
            (new PerfilView($encuestas,$encuestasCompartidas))->render();
        }

    }
}
        ?>