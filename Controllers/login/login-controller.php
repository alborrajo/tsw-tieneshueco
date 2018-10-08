<?php
include_once "Views/header-view.php";
include_once "Views/footer-view.php";

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
					if($_POST["email"] == "login" && $_POST['password'] == "password"){//Si se ha encontrado ese login con esa contraseña
						$_SESSION["email"] = $_POST["email"];//Inicializar session login a lo enviado
						header('Location: index.php');//Ahora que se ha logeado se vuelve al index
					}
					else { //Si el login es invalido
						header('Location: index.php?controller=login&action=loginError'); //Redirigir al login por GET con accion loginError
					}
					break;
				
				case "register":
					//TODO: Añadir datos a la BD
					//		Añadir email, contraseña y nombre
					//TODO: Establecer sesion con datos añadidos
					//Codigo de ejemplo
					$_SESSION["email"] = $_POST["email"];
					header('Location: index.php'); //Redirigir al index
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
					(new HeaderView(true))->render();
					(new LoginView("Login inválido"))->render();//Mostrar vistaLogin
					(new FooterView())->render();
					break;
				case "unknown":
					(new HeaderView(true))->render();
					(new LoginView("Acción desconocida"))->render();//Mostrar vistaLogin
					(new FooterView())->render();
					break;
				case "register":
					(new HeaderView(true))->render();
					(new RegisterView())->render();//Mostrar vistaLogin
					(new FooterView())->render();
					break;
				default:
					(new HeaderView(true))->render();
					(new LoginView())->render();//Mostrar vistaLogin
					(new FooterView())->render();
					break;
			}
		}
		//Si no se recibe nada
		else {
			(new HeaderView(true))->render();
			(new LoginView())->render();//Mostrar vistaLogin
			(new FooterView())->render();
		}

	}
}
?>