<?php
    session_start();

    //Locale
    include "Locale/en.php"; //English by default

    if(isset($_REQUEST["locale"])) {
        switch($_REQUEST["locale"]) {
            case "es":
                $_SESSION["locale"] = "es";
                break;
            default:
                $_SESSION["locale"] = "en";
        }
    }

    if(isset($_SESSION["locale"])) {
        include "Locale/".$_SESSION["locale"].".php";
    }

    //Si se ha especificado el controller al que ir
    if(isset($_REQUEST["controller"])) {
        //Si el usuario está logeado, puede ir a los siguientes controladores:
        if(isset($_SESSION["email"])) {
            switch($_REQUEST["controller"]) {
                case "perfil":
                    include_once "Controllers/perfil/perfil-controller.php";
                    new PerfilController();
                    break;
                case "encuesta":
                    include_once "Controllers/encuesta/encuesta-controller.php";
                    new EncuestaController();
                    break;
                default:
                    //Si es un controller raro, ir al perfil
                    include_once "Controllers/perfil/perfil-controller.php";
                    new PerfilController();
                    break;
            }
        }
        //Si no, puede ir a estos
        else {
            switch($_REQUEST["controller"]) {
                case "login":
                    include_once "Controllers/login/login-controller.php";
                    new LoginController();
                    break;
                default:
                    //Si es un controller raro, ir al login
                    include_once "Controllers/login/login-controller.php";
                    new LoginController();
                    break;
            }
        }
    }

    //Si no se ha especificado
    else {
        //Si está logeado, ir al perfil
        if(isset($_SESSION["email"])) {
            include_once "Controllers/perfil/perfil-controller.php";
            new PerfilController();
        }
        //Si no, ir al login
        else {
            include_once "Controllers/login/login-controller.php";
            new LoginController();
        }
    }
    
?>
