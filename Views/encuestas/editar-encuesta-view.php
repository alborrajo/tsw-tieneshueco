<?php
include_once "Classes/Encuesta.php";
include_once "Classes/Fecha.php";
include_once "Classes/Hora.php";
include_once "Classes/Voto.php";
include_once "Classes/MSGException.php";


include_once "Views/plantilla-view.php";

class EditarView extends PlantillaView{

	private $encuesta;
	private $votos;
	private $msg;

	function __construct($encuesta, $msg=NULL)
	{
		$this->encuesta = $encuesta;
		parent::__construct(true);
	}
	

	function _render()
	{

		?>


<main class="container">

	<div id="divdescripcion">
		<h1> <?php echo $this->encuesta->getNombre();?> </h1>
		<p> Ahora podrás editar tu encuesta, decide entre que días estará la votación y envía el enlace generado para que la
			gente empiece a votar. </p>
		<br />
		<h3> Edita tu encuesta. </h3>
	</div>

	<div class="container mx-auto">


		<?php
		for($i = 0; $i < count($this->encuesta->getFechas()); $i++) {
			if($i % 3 == 0) {
				?><div class="row"><?php
			}
			?>
			<div class="col-sm-4">

				<ul class="list-group">
					<li class="list-group-item">
						<h4>
							<?php echo $this->encuesta->getFechas()[$i]->getFecha();?>
							
							<form class="d-inline float-right form-inline" action="index.php" method="POST">
								<input type="hidden" name="action" value="delFecha" />
								<input type="hidden" name="controller" value="encuesta" />
								<input type="hidden" name="idEncuesta" value="<?php echo $this->encuesta->getID();?>" />
								<input type="hidden" name="fecha" value="<?php echo $this->encuesta->getFechas()[$i]->getFecha();?>" />
								<button type="submit" class="btn btn-danger"><span class="fas fa-trash-alt"></span></button>
							</form>
						</h4>
					</li>

					<?php
					if(!empty($this->encuesta->getFechas()[$i]->getHoras())) {
						foreach($this->encuesta->getFechas()[$i]->getHoras() as $hora) {
							?>	
							<li class="list-group-item">
								<?php echo $hora->getHoraInicio()." - ".$hora->getHoraFin();?>

								<!-- boton eliminar para hora -->
								<form class="d-inline float-right form-inline" action="index.php" method="POST">
									<input type="hidden" name="action" value="delHora" />
									<input type="hidden" name="controller" value="encuesta" />
									<input type="hidden" name="idEncuesta" value="<?php echo $this->encuesta->getID();?>" />
									<input type="hidden" name="fecha" value="<?php echo $this->encuesta->getFechas()[$i]->getFecha();?>" />
									<input type="hidden" name="horaInicio" value="<?php echo $hora->getHoraInicio();?>" />
									<input type="hidden" name="horaFin" value="<?php echo $hora->getHoraFin();?>" />
									<button type="submit" class="btn btn-danger btn-sm"><span class="fas fa-trash-alt"></span></button>
								</form>
							</li>
							<?php
						}
					}
					?>

						<li class="list-group-item">
							<form class="form-inline" action="index.php" method="POST">
								<input type="time" name="horaInicio" class="form-control form-control-sm">
								<input type="time" name="horaFin" class="form-control form-control-sm">
								<input type="hidden" name="action" value="addHora" />
								<input type="hidden" name="controller" value="encuesta" />
								<input type="hidden" name="idEncuesta" value="<?php echo $this->encuesta->getID();?>" />
								<input type="hidden" name="fecha" value="<?php echo $this->encuesta->getFechas()[$i]->getFecha();?>" />
								<button type="submit" class="btn btn-primary btn-sm float-right"><span class="fas fa-plus-circle"></span></button>
							</form>
						</li>

				</ul>
			</div>

			<?php
			if($i % 3 == 2) {
				?></div><?php
			}
		}
		?>

	</div>

	<div>
		<h4>Nueva fecha</h4>
		<form class="form-inline" action="index.php" method="POST">
			<input type="date" name="fecha" class="form-control"/>
			<input type="hidden" name="idEncuesta" value="<?php echo $this->encuesta->getID();?>" />
			<input type="hidden" name="action" value="addFecha" />
			<input type="hidden" name="controller" value="encuesta" />
			<button type="submit" class="btn btn-primary"><span class="fas fa-plus-circle"></span></button>
		</form>
	</div>

	<br/>

	<div class="mx-auto">
		<p> Comparte este link para que la gente participe </p>
		<input id="shareURL" class="form-control" type="text" size="35" value="" />

		<script>
			var host = window.location.hostname;
			var shareURL = document.getElementById("shareURL");

			shareURL.value = "http://"+host+"/index.php?controller=encuesta&action=participarencuesta&id=<?php echo $this->encuesta->getID();?>";
		</script>
	</div>

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