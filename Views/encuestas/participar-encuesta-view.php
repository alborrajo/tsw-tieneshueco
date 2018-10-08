<?php
include_once "Classes/Encuesta.php";
include_once "Classes/Fecha.php";
include_once "Classes/Hora.php";
include_once "Classes/Voto.php";

class ParticiparView {
	function __construct($encuesta, $votos, $msg=NULL)
	{
		?>

		<main class= "container">
			<div id="divdescripcion">
			<p> <?php echo $encuesta->getNombre();?> </p>
			<br/>
			<em> Participa en la encuesta. </em>
			</div>

		<div id="encuesta">
			<table class="table-bordered">
				<tr>
					<th colspan="2">
						Fechas
					</th>
				<?php
				//Insertamos las fechas en la primera fila de la tabla
				$fechas = $encuesta->getFechas();
					foreach($fechas as $fecha)
					{
						?>
						<th colspan=<?php echo count($fecha->getHoras())?>>
							<?php echo $fecha->getFecha();?>
						</th>
						<?php
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
			$votosAgrupados = $this->subgruposVotos($votos);
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
								if($usuario==$_SESSION["email"])
								{
								?>
								<td>
									<form action="delVoto" method="post">
										<input type="submit" value="votado" checked="checked"/>
									</form>
								</td>
								<?php
								}
								else
								{
									?>
									<td>
										<img src="images/voto.png" height="64" width="64"/>
									</td>

									<?php
								}
								
							}
							else
							{
								if($usuario!=$_SESSION["email"])
								{
								?>
								<td>
								</td>
								<?php
							}
							else
							{
								?>

								<td>
									<form action="addVoto" method="post">
										<input type="submit" value="No votado" checked="checked"/>
									</form>
								</td>
								<?php

							}
							}
							
							?>
							<?php
						}
					}
					?>
				</tr>
				<?php
			}
			?>
			<?php

			?>


				
			</table>
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