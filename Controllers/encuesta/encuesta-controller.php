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
						if($_POST["idEncuesta"] && $_POST["fecha"] && $_POST["hora"])
						{
							//Anhadir un voto a esa encuesta con el usuario de la sesion 

						}
						header("Location: index.php?controller=encuesta&action=participarencuesta");
						break;

					case "delVoto":
						if($_POST["idEncuesta"] && $_POST["fecha"] && $_POST["hora"])
						{
							//Borrar un voto a esa encuesta con el usuario de la sesion 
							
						}
						header("Location: index.php?controller=encuesta&action=participarencuesta");
						break;

					case "addFecha":
						if($_POST["idEncuesta"] && $_POST["fecha"])
						{	

						}
						header("Location: index.php?controller=encuesta&action=editencuesta");
						break;

					case "addHora":
						if($_POST["idEncuesta"] && $_POST["fecha"] && $_POST["hora"])
						{
							//TODO: Anhadir a la tabla horas una nueva tupla con el id de la encuesta, la fecha y la hora de inicio y fin.
						}
						header("Location: index.php?controller=encuesta&action=editencuesta");
						break;

					case "delFecha":
						if($_POST["idEncuesta"] && $_POST["fecha"])
						{
							//TODO: Eliminar de la tabla fecha la tupla que se corresponda con la encuesta y la fecha seleccionadas.
						}
						header("Location: index.php?controller=encuesta&action=editencuesta");
						break;

					case "delHora":
						if($_POST["idEncuesta"] && $_POST["fecha"] && $_POST["hora"])
						{
							//TODO: Eliminar de la tabla horas la tupla que se corresponda con la encuesta, fecha y hora seleccionadas.
							//TODO: Anhadir a la tabla horas una nueva tupla con el id de la encuesta, la fecha y la hora de inicio y fin.
						}
						header("Location: index.php?controller=encuesta&action=editencuesta");
						break;

					default:
						header("Location: index.php");
						break;
				}
			}
			elseif(isset($_GET["action"]))
			{
				switch($_GET["action"])
				{
					case "editencuesta":
						//Comprobar si el usuario actual es el propietario de la encuesta
						$perfilModel = new PerfilModel();
						if($perfilModel->getPropietarioEncuesta($_GET["id"]) == $_SESSION["email"]) {
							//Obtener datos de la encuesta de la BD
							$encuesta = $encuestaModel->getEncuesta($_GET["id"]);
							(new EditarView($encuesta))->render();
						}
						else {
                            throw new MSGException("La encuesta a editar no pertenece al usuario","warning");
                        }						
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