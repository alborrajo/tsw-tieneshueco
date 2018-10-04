<?php
include_once "../../Views/header-view.php";
include_once "../../Views/header-view.php";

include_once "../../Views/encuestas/participar-encuesta-view.php";
include_once "../../Views/encuestas/editar-encuesta-view.php";

include_once "../../Classes/Encuesta.php";

class EncuestaController
{
	function __construct()
	{
		if(isset($_POST["action"]))
		{

			switch($_POST["action"])
			{
				case "participar":
					//TODO: Anhadir o borrar una tupla de la tabla que relaciona usuarios y votos.
				break;

				case "addFecha":
					//TODO: Anhadir a la tabla fechas una nueva tupla con el id de la encuesta y la fecha.

				break;

				case "addHora":
					//TODO: Anhadir a la tabla horas una nueva tupla con el id de la encuesta, la fecha y la hora de inicio y fin.

				break;

				case "delHora":
					//TODO: Eliminar de la tabla horas la tupla que se corresponda con la encuesta, fecha y hora seleccionadas.

				break;

				case "delFecha":
					//TODO: Eliminar de la tabla fecha la tupla que se corresponda con la encuesta y la fecha seleccionadas.

				break;
			}
		}
		elseif(isset($_GET["action"]))
		{
			switch($_GET["action"])
			{
				case "edit":
					//TODO: Obtener la encuesta en la BD por medio de su link.
					//Mostrar la vista edit de esa encuesta
					break;

				case "participar":
					//TODO: Obtener la encuesta en la BD por medio de su link.
					//Mostrar la vista participar para esa encuesta.
					break;
			}
		}
		else
		{
			$encuesta = new Encuesta("tieneshueco.com/enlace1284u28o3uroweh", "Pachanga brava", "Manolo el del bombo", Array("Sabado 15 agosto", "Domingo 16 agosto") );

			new HeaderView(true);
			new ParticiparView($encuesta);
			new FooterView(true);
		}
	}
}
?>