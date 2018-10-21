<?php

include_once 'Views/login/login-view.php';//Incluir vistaLogin
include_once 'Views/login/register-view.php';//Incluir vistaRegistro

class LoginController {

    function __construct() {
		//Si se recibe un POST
		if(isset($_POST["action"])) {
			switch($_POST["action"]) {
				//Si es un POST de login
				case "login":
					//TODO: Comprobar login en la BD
					//Codigo de ejemplo

					if(isset($_POST["email"]) && isset($_POST["password"]))
					{
					include 'Models/login/login-model.php';
					$usuario = new LoginModel();
					$respuesta = $usuario->login($_REQUEST['email'],$_REQUEST['password']);

					if ($respuesta == 'true'){ //Si se ha encontrado ese email con esa contraseña
						$_SESSION["email"] = $_POST["email"];//Inicializar session login a lo enviado
						header('Location: index.php');//Ahora que se ha logeado se vuelve al index
					}

					else { //Si el login es invalido
						header('Location: index.php?controller=login&action=loginError'); //Redirigir al login por GET con accion loginError
					}
					}
					break;
				
				case "register":
					//TODO: Añadir datos a la BD
					//		Añadir email, contraseña y nombre
					//TODO: Establecer sesion con datos añadidos
					//Codigo de ejemplo
					if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["nombre"]))
					{
					include 'Models/login/login-model.php';
					$usuario = new LoginModel();
					$respuesta = $usuario->Register($_REQUEST['email']);

					if ($respuesta == 'true'){
						$respuesta = $usuario->registrar($_REQUEST['email'],$_REQUEST['password'],$_REQUEST['nombre']);
						header('Location: index.php?controller=login&action=registerComplete');
					}
					else{
						header('Location: index.php?controller=login&action=registerError');
						
					}
					}
					break;

				default:
					//Si se recibe un POST raro
					//Redirigir por GET con accion unknown
					header('Location: index.php?controller=login&action=unknown');
			}
		}
		//Si se recibe por GET
		elseif(isset($_GET["action"])) {
			switch($_GET["action"]) {
				case "loginError":
					(new LoginView("Login inválido"))->render();//Mostrar vistaLogin
					break;
				case "unknown":
					(new LoginView("Acción desconocida"))->render();//Mostrar vistaLogin
					break;
				case "register":
					(new RegisterView())->render();//Mostrar vistaRegistro
					break;
				case "registerError":
					(new RegisterView("Error, el email ya está en uso"))->render();//Mostrar vistaRegistro
					break;
				case "registerComplete":
					(new LoginView("Usuario registrado"))->render();//Mostrar vistaRegistro
					break;
				default:
					(new LoginView())->render();//Mostrar vistaLogin
					break;
			}
		}
		//Si no se recibe nada
		else {
			(new LoginView())->render();//Mostrar vistaLogin
		}

	}
}
?>