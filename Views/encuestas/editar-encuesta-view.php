<?php
include_once "Classes/Encuesta.php";
include_once "Classes/Fecha.php";
include_once "Classes/Hora.php";
include_once "Classes/Voto.php";

include_once "Views/plantilla-view.php";
?>

<?php
class EditarView extends PlantillaView{

	private $encuesta;
	private $votos;
	private $msg;

	function __construct($encuesta,$votos, $msg=NULL)
	{
		$this->encuesta = $encuesta;
		$this->votos = $votos;
	}
	

	function _render()
	{

		?>

		<main class= "container">
			<div id="divdescripcion">
			<p> Ahora podrás editar tu encuesta, decide entre que días estará la votación y envía el enlace generado para que la gente empiece a votar. </p>
			<br/>
			<em> Edita tu encuesta. </em>
			</div>
				<div class="linkencuesta">

					<p> Este es el link de tu encuesta: </p>
					<input type="text" readonly="readonly" size="50" value=<?php echo $encuesta->getID()?> >
					<p> Compártelo para que la gente empiece a votar.</p>
				</div>

		<?php if($msg != null) { //Mostrar alerta si la variable $msg está establecida ?>
            <div class="alert" role="alert">
                <?php echo $msg; ?>
            </div>       
        <?php } ?>
		</main>


		<?php
		
		}
	function subgruposVotos($votos)
	{
		//Creamos subgrupos con los votos de cada usuario
			$usuarioActual = $votos[0]->getUsuario();
			$votosAgrupados=Array();
			$i = 0;
			$k = 0;

			foreach($votos as $voto)
			{
				if($voto->getUsuario()==$usuarioActual)
				{
					$votosAgrupados[$i][$k]=$voto;
					$k++;
				}
				else
				{
					$k=0;
					$i++;
					$votosAgrupados[$i][$k]=$voto;
				}
			}
			return $votosAgrupados;
	}

	function ordenarSubgrupos($subgrupo, $fechas)
	{
		$subgrupoOrdenado = Array();
		for($i=0;$i<count($subgrupo);$i++)
		{
			array_push($subgrupoOrdenado, $subgrupo[0]);
		}

		$j=0;

		foreach($fechas as $fecha)
		{
			$fechaActual=$fecha->getFecha();

			for($i=0;$i<count($subgrupo);$i++)
			{
				if($fechaActual==$subgrupo[$i]->getFecha())
				{
					$subgrupoOrdenado[$j]=$subgrupo[$i];
					$j++;
				}
			}
		}
		return $subgrupoOrdenado;
	}

	function comprobarVoto($fecha, $hora, $votos)
	{
		$toret=false;

		foreach($votos as $voto)
		{
			if($fecha->getFecha()==$voto->getFecha() && $hora->getHoraInicio()==$voto->getHoraInicio()
				&& $hora->getHoraFin()==$voto->getHoraFin())
			{
				$toret = true;
			}
		}
		return $toret;

	}
}
?>