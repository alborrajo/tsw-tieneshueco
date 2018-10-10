<?php
include_once "Classes/Encuesta.php";
include_once "Classes/Fecha.php";
include_once "Classes/Hora.php";
include_once "Classes/Voto.php";

include_once "Views/plantilla-view.php";

class EditarView extends PlantillaView{

	private $encuesta;
	private $votos;
	private $msg;

	function __construct($encuesta,$votos, $msg=NULL)
	{
		$this->encuesta = $encuesta;
		$this->votos = $votos;
		parent::__construct(true);
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
		
			<div id="encuesta">
			<table class="table-bordered">
				<tr>
					<th colspan="2">

					</th>
				<?php
				
				//Insertamos las fechas en la primera fila de la tabla
				$fechas = $this->encuesta->getFechas();
					foreach($fechas as $fecha)
					{
						?>
						<th colspan=<?php echo count($fecha->getHoras())?>>
							<form action="index.php" method="POST">
								<input type="hidden" name="action" value="delFecha"/>
								<input type="hidden" name="controller" value="encuesta"/>
								<input type="hidden" name="idEncuesta" value="<?php echo $this->encuesta->getID();?>"/>
								<input type="hidden" name="fecha" value="<?php echo $fecha->getFecha();?>"/>
								<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
							</form>
						</th>
						<?php
					}
					?>
				</tr>


				<tr>
					<th colspan="2">
						Fechas
					</th>
				<?php
				//Insertamos las fechas en la primera fila de la tabla
					foreach($fechas as $fecha)
					{
						?>
						<th colspan=<?php echo count($fecha->getHoras())?>>
							<?php echo $fecha->getFecha();?>
							<form action="index.php" method="POST">
								<input type="hidden" name="action" value="addHora"/>
								<input type="hidden" name="controller" value="encuesta"/>
								<input type="hidden" name="idEncuesta" value="<?php echo $this->encuesta->getID();?>"/>
								<input type="hidden" name="fecha" value="<?php echo $fecha->getFecha();?>"/>
								<button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i></button>
							</form>
								
						</th>
						<?php
					}
					?>
				</tr>

			<tr>
				<th colspan="2">
				</th>
				<?php
				//Insertamos las horas en la segunda fila de la tabla
				foreach($fechas as $fecha)
				{
					$horas = $fecha->getHoras();
					foreach($horas as $hora)
					{
						?>
						<td>
							<?php //Insertar boton eliminar para todas las horas ?>
							<form action="index.php" method="POST">
								<input type="hidden" name="action" value="delHora"/>
								<input type="hidden" name="controller" value="encuesta"/>
								<input type="hidden" name="idEncuesta" value="<?php echo $this->encuesta->getID();?>"/>
								<input type="hidden" name="fecha" value="<?php echo $fecha->getFecha();?>"/>
								<input type="hidden" name="horaInicio" value="<?php echo $hora->getHoraInicio();?>"/>
								<input type="hidden" name="horaFin" value="<?php echo $hora->getHoraFin();?>"/>
								<input type="submit" name="eliminarHora" value="Borrar hora"/>
							</form>
						</td>
						<?php
					}
				}
				?>
			</tr>

			<tr>
				<th colspan="2">
					Horas
				</th>
				<?php
				//Insertamos las horas en la segunda fila de la tabla
				foreach($fechas as $fecha)
				{
					$horas = $fecha->getHoras();
					foreach($horas as $hora)
					{
						?>
						<td>
							<?php //Insertar boton eliminar para todas las horas ?>
							<?php echo $hora->getHoraInicio()."-";?>
							<?php echo $hora->getHoraFin();?>
						</td>
						<?php
					}
				}
				?>
			</tr>

			<?php


			//Creamos subgrupos con los votos de cada usuario
			$votosAgrupados = $this->subgruposVotos($this->votos);
			//var_dump($votosAgrupados);

			//Ordenar los votos segun el orden de las fechas en la encuesta
			//Coger la primera fecha, si para el primer subarray de votos hay un voto en esa fecha que esta 
			//vaya de primera.
				for($i=0;$i<count($votosAgrupados);$i++)
				{
					$subgrupo=$votosAgrupados[$i];
					$subgrupoOrdenado=$this->ordenarSubgrupos($subgrupo, $fechas);
					$votosAgrupados[$i]=$subgrupoOrdenado;
				}
				//var_dump($votosAgrupados);
			for($i=0;$i<count($votosAgrupados);$i++)
			{
				$usuario =$votosAgrupados[$i][0]->getUsuario();
				?>
				<tr>
					<th colspan="2">
						<?php echo $usuario;?>
					</th>
					<?php
					foreach($fechas as $fecha)
					{
						foreach($horas as $hora)
						{
							$voto = $this->comprobarVoto($fecha,$hora,$votosAgrupados[$i]);
							if($voto==true)
							{
								?>
								<td>
									<img src="images/voto.png" height="64" width="64"/>
								</td>

								<?php
							}
							else
							{
								?>
								<td>
								</td>
								<?php
							}
							}
						}
					}
					?>
				</tr>
			</table>
		</div>
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