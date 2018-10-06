<?php
include_once "Views/header-view.php";
include_once "Views/footer-view.php";

include_once "Views/encuestas/participar-encuesta-view.php";
include_once "Views/encuestas/editar-encuesta-view.php";

include_once "Classes/Encuesta.php";
include_once "Classes/Fecha.php";
include_once "Classes/Hora.php";

class EncuestaController
{
	function __construct()
	{
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
					//TODO: Anhadir a la tabla fechas una nueva tupla con el id de la encuesta y la fecha.
				if($_POST["idEncuesta"] && $_POST["fecha"])
				{

				}
				header("Location: index.php?controller=encuesta&action=editencuesta");

				break;

				case "addHora":
					//TODO: Anhadir a la tabla horas una nueva tupla con el id de la encuesta, la fecha y la hora de inicio y fin.
				if($_POST["idEncuesta"] && $_POST["fecha"] && $_POST["hora"])
				{

				}
				header("Location: index.php?controller=encuesta&action=editencuesta");

				break;

				case "delFecha":
					//TODO: Eliminar de la tabla fecha la tupla que se corresponda con la encuesta y la fecha seleccionadas.
				if($_POST["idEncuesta"] && $_POST["fecha"])
				{

				}
				header("Location: index.php?controller=encuesta&action=editencuesta");

				break;

				case "delHora":
					//TODO: Eliminar de la tabla horas la tupla que se corresponda con la encuesta, fecha y hora seleccionadas.
					//TODO: Anhadir a la tabla horas una nueva tupla con el id de la encuesta, la fecha y la hora de inicio y fin.
				if($_POST["idEncuesta"] && $_POST["fecha"] && $_POST["hora"])
				{

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
					//TODO: Obtener la encuesta en la BD por medio de su link.
					//Mostrar la vista edit de esa encuesta
					break;

				case "participarencuesta":
					//TODO: Obtener la encuesta en la BD por medio de su link.
					//Mostrar la vista participar para esa encuesta.
					break;

				default:
				header("Location: index.php");
					break;
			}
		}
		else
		{
			
			$horas = Array(new Hora("10:45","12:45"),new Hora("10:45","12:45"),new Hora( "10:45","12:45"));

			$fechas = Array(new Fecha("Sabador 15 agosto", $horas), new Fecha("Viernes 14 agosto", $horas),new Fecha("Lunes 20 agosto", $horas));

			$encuesta = new Encuesta("tieneshueco.com/enlace1284u28o3uroweh", "Pachanga brava", "Manolo el del bombo", $fechas);
			new HeaderView(true);
			new ParticiparView($encuesta);
			new FooterView(true);
		}
	}
}
?>