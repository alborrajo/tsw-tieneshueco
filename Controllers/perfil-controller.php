<?php
include_once "Views/header-view.php";
include_once "Views/footer-view.php";

include_once "Views/perfil-view.php";
include_once "Classes/Encuesta.php";

session_start();

class PerfilController {
    function __construct() {
        //Si hay sesión iniciada
        if(isset($_SESSION["email"])) {
            //TODO: Comprobar si la sesión es válida con el modelo del login
            //if valida:
                if(isset($_POST["action"])) {
                    //Si vienen acciones por POST (Inserciones, modificaciones y borrados en la BD)
                    switch($_POST["action"]) {
                        case "nuevaEncuesta":
                            //TODO: Añadir nueva encuesta en la BD usando
                            echo "Nombre:\t", $_POST["nombre"];
                            ?><br><?php //Y
                            echo "ID:\t".md5(uniqid($_SESSION["email"], true));
                            //TODO: Redirigir al controlador de ENCUESTAS con accion de EDITAR la encuesta generada
                    }
                }
                else if(isset($_GET["action"])) {
                    //Si vienen acciones por GET (Consultas en la BD)
                }
                
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
                new Header();
                new PerfilView($encuestas,$encuestasCompartidas);
                new Footer();
        }

        //Si no, redirigir al login
        else {
            //TODO: Redirigir al login
            //Codigo TEMPORAL para probar sin tener login
            if(isset($_GET["email"])) {
                var_dump($_GET);
                echo "Logeado, haz F5 para entrar en la webapp"; //TODO, hacer esto automatico
                $_SESSION["email"]=$_GET["email"];
            }
            else {
                var_dump($_GET);
                echo "No hay sesión";
                ?>
                <form method="get">
                    <input type="hidden" name="email" value="propie@tar.io">
                    <input type="submit" value="login">
                </form>
                <?php
            }
        }

    }
}
        ?>