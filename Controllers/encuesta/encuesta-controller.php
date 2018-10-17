<?php

include_once "Views/encuestas/participar-encuesta-view.php";
include_once "Views/encuestas/editar-encuesta-view.php";

include_once "Models/encuesta/encuesta-model.php";
include_once "Models/perfil/perfil-model.php";

include_once "Classes/Encuesta.php";
include_once "Classes/Fecha.php";
include_once "Classes/Hora.php";
include_once "Classes/MSGException.php";


class EncuestaController
{
	function __construct()
	{
		
		try {

			$encuestaModel = new EncuestaModel();

			if(isset($_POST["action"]))
			{

				switch($_POST["action"])
				{

					case "addVoto":
						if(isset($_POST["idEncuesta"]) && isset($_POST["fecha"]) && isset($_POST["horaInicio"])
						 && isset($_POST["horaFin"]))
						{
							//Anhadir un voto a esa encuesta con el usuario de la sesion 
							$encuestaModel->addVoto($_POST["idEncuesta"], $_SESSION["email"], $_POST["fecha"]
							, $_POST["horaInicio"], $_POST["horaFin"]);

						}
						header("Location: index.php?controller=encuesta&action=participarencuesta");
						break;


					case "delVoto":
					if(isset($_POST["idEncuesta"]) && isset($_POST["fecha"]) && isset($_POST["horaInicio"]) &&
					isset( $_POST["horaFin"]))
					{
						//Anhadir un voto a esa encuesta con el usuario de la sesion 
						$encuestaModel->delVoto($_POST["idEncuesta"], $_SESSION["email"], $_POST["fecha"]
						, $_POST["horaInicio"], $_POST["horaFin"]);

					}
						header("Location: index.php?controller=encuesta&action=participarencuesta");
						break;



					case "addFecha":
						if(isset($_POST["idEncuesta"]) && isset($_POST["fecha"]))
						{
							//Comprobar si el usuario actual es el propietario de la encuesta
							$perfilModel = new PerfilModel();
							if($perfilModel->getPropietarioEncuesta($_POST["idEncuesta"]) != $_SESSION["email"]) {
								throw new MSGException("La encuesta a editar no pertenece al usuario","warning");
							}

							$encuestaModel->addFecha($_POST["idEncuesta"], $_POST["fecha"]);
						}
						header("Location: index.php?controller=encuesta&action=editencuesta&id=".$_POST["idEncuesta"]);
						break;

					case "addHora":
						if(isset($_POST["idEncuesta"]) && isset($_POST["fecha"]) && isset($_POST["horaInicio"])
						 && isset($_POST["horaFin"]))
						{
							//Comprobar si el usuario actual es el propietario de la encuesta
							$perfilModel = new PerfilModel();
							if($perfilModel->getPropietarioEncuesta($_POST["idEncuesta"]) != $_SESSION["email"]) {
								throw new MSGException("La encuesta a editar no pertenece al usuario","warning");
							}
								
							$encuestaModel->addHora($_POST["idEncuesta"], $_POST["fecha"], $_POST["horaInicio"], $_POST["horaFin"]);
						}
						header("Location: index.php?controller=encuesta&action=editencuesta&id=".$_POST["idEncuesta"]);
						break;

					case "delFecha":
						if(isset($_POST["idEncuesta"]) && isset($_POST["fecha"]))
						{
							//Comprobar si el usuario actual es el propietario de la encuesta
							$perfilModel = new PerfilModel();
							if($perfilModel->getPropietarioEncuesta($_POST["idEncuesta"]) != $_SESSION["email"]) {
								throw new MSGException("La encuesta a editar no pertenece al usuario","warning");
							}

							$encuestaModel->delFecha($_POST["idEncuesta"], $_POST["fecha"]);
						}
						header("Location: index.php?controller=encuesta&action=editencuesta&id=".$_POST["idEncuesta"]);
						break;

					case "delHora":
						if(isset($_POST["idEncuesta"]) && isset($_POST["fecha"]) && isset($_POST["horaInicio"])
						 && isset($_POST["horaFin"]))
						{
							//Comprobar si el usuario actual es el propietario de la encuesta
							$perfilModel = new PerfilModel();
							if($perfilModel->getPropietarioEncuesta($_POST["idEncuesta"]) != $_SESSION["email"]) {
								throw new MSGException("La encuesta a editar no pertenece al usuario","warning");
							}
								
							$encuestaModel->delHora($_POST["idEncuesta"], $_POST["fecha"], $_POST["horaInicio"], $_POST["horaFin"]);
						}
						header("Location: index.php?controller=encuesta&action=editencuesta&id=".$_POST["idEncuesta"]);
						break;

					default:
						header("Location: index.php");
						break;
				}
			}
			elseif(isset($_GET["action"]) && isset($_GET["id"]))
			{
				switch($_GET["action"])
				{
					case "editencuesta":
						//Obtener datos de la encuesta de la BD
						$encuesta = $encuestaModel->getEncuesta($_GET["id"]);
						(new EditarView($encuesta))->render();		
						break;

					case "participarencuesta":
						$encuesta = $encuestaModel->getEncuesta($_GET["id"]);
						$votos = $encuestaModel->getVotosOnEncuesta($_GET["id"]);

						(new ParticiparView($encuesta,$votos,$_SESSION["email"]))->render();
						break;

					default:
						header("Location: index.php");
						break;
				}
			}
			else
			{
				header("Location: index.php");
			}
		} catch(MSGException $e) {
			echo $e->getMessage();
			exit;
			MSGException::setTemporalMessage($e); //Añadir mensaje temporal de error
        	header("Location: /index.php?controller=perfil"); //Redirigir al perfil sin accion
		}
	}

}
?>