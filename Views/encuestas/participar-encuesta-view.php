<?php
include_once "Classes/Encuesta.php";
include_once "Classes/Fecha.php";
include_once "Classes/Hora.php";
include_once "Classes/Voto.php";

include_once "Views/plantilla-view.php";

class ParticiparView extends PlantillaView {

	private $encuesta;
	private $votos;
	private $usuarioVotante;
	private $msg;

	function __construct($encuesta, $votos, $usuarioVotante, $msg=NULL)
	{
		$this->encuesta = $encuesta;
		$this->votos = $votos;
		$this->usuarioVotante = $usuarioVotante;
		$this->msg = $msg;
		parent::__construct(true);
	}

	function _render() {

		$creadaFilaVotante = false;

		?>
		<main class= "container">
			<div id="divdescripcion">
				<h1> <?php echo $this->encuesta->getNombre();?> </h1>
				<br/>
				<h4> Participa en la encuesta. </h4>
			</div>

			<div id="encuesta">
				<table class="table table-responsive">
					<thead>
						<tr>
							<th colspan="2">
								Fechas
							</th>
						<?php
						//Insertamos las fechas en la primera fila de la tabla
						$fechas = $this->encuesta->getFechas();
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
					</thead>

					<tbody>
						<tr>
							<th colspan="2">
								Horas
							</th>
							<?php
							//Insertamos las horas en la segunda fila de la tabla
							foreach($fechas as $fecha)
							{
								$horas = $fecha->getHoras();
								if(!empty($horas))
								{
								foreach($horas as $hora)
								{
									?>
									<td>
										<?php echo $hora->getHoraInicio()." - ".$hora->getHoraFin(); ?>
									</td>
									<?php
								}
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
											if($usuario==$this->usuarioVotante)
											{
												$creadaFilaVotante = true;
											?>
											<td>
												<form action="index.php" method="post">
													<input type="hidden" name="controller" value="encuesta">
													<input type="hidden" name="action" value="delVoto">
													<input type="hidden" name="email" value="<?php echo $usuario ?>">
													<input type="hidden" name="idEncuesta" value="<?php echo $this->encuesta->getID() ?>">
													<input type="hidden" name="fecha" value="<?php echo $fecha->getFecha() ?>">
													<input type="hidden" name="horaInicio" value="<?php echo $hora->getHoraInicio() ?>">
													<input type="hidden" name="horaFin" value="<?php echo $hora->getHoraFin() ?>">
													<button type="submit" class="btn btn-success btn-sm" value="votado"><span class="far fa-envelope"></span></button>
												</form>
											</td>
											<?php
											}
											else
											{
											?>
											<td>
												<i class="fas fa-check-circle fa-3x color-blue"></i>
											</td>

											<?php
											}
											
										}
										else
										{
											if($usuario!=$this->usuarioVotante)
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
												<form action="index.php" method="post">
													<input type="hidden" name="controller" value="encuesta">
													<input type="hidden" name="action" value="addVoto">
													<input type="hidden" name="email" value="<?php echo $usuario ?>">
													<input type="hidden" name="idEncuesta" value="<?php echo $this->encuesta->getID() ?>">
													<input type="hidden" name="fecha" value="<?php echo $fecha->getFecha() ?>">
													<input type="hidden" name="horaInicio" value="<?php echo $hora->getHoraInicio() ?>">
													<input type="hidden" name="horaFin" value="<?php echo $hora->getHoraFin() ?>">
													<button type="submit" class="btn btn-warning btn-sm" value="votado"><span class="far fa-envelope"></span></button>
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
						//TODO:
						//IF filaVotante no creada crear una nueva fila con botones no votado para todas las horas
						if($creadaFilaVotante==false)
						{
							?>
							<tr>

								<th colspan="2">

									<?php echo $_SESSION["email"];?>

								</th>

								<?php
									foreach($fechas as $fecha)
									{
										foreach($horas as $hora)
										{
											?>
											<td>
											<form action="index.php" method="post">
													<input type="hidden" name="controller" value="encuesta">
													<input type="hidden" name="action" value="addVoto">
													<input type="hidden" name="email" value="<?php echo $_SESSION["email"] ?>">
													<input type="hidden" name="idEncuesta" value="<?php echo $this->encuesta->getID() ?>">
													<input type="hidden" name="fecha" value="<?php echo $fecha->getFecha() ?>">
													<input type="hidden" name="horaInicio" value="<?php echo $hora->getHoraInicio() ?>">
													<input type="hidden" name="horaFin" value="<?php echo $hora->getHoraFin() ?>">
													<button type="submit" class="btn btn-warning btn-sm" value="votado"><span class="far fa-envelope"></span></button>
											</form>
											</td>
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
					</tbody>

					
				</table>
			</div>

		<?php if($this->msg != null) { //Mostrar alerta si la variable $msg está establecida ?>
            <div class="alert" role="alert">
                <?php echo $this->msg; ?>
            </div>       
            <?php } ?>

        </main>
        <?php
	}

	
	function subgruposVotos($votos)
	{
		$votosAgrupados=Array();
		//Creamos subgrupos con los votos de cada usuario
		if(!empty($votos))
		{
			$usuarioActual = $votos[0]->getUsuario();
			
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
					$usuarioActual = $voto->getUsuario();
					$k++;
				}
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