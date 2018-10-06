<?php
include_once "Classes/Encuesta.php";
include_once "Classes/Fecha.php";
include_once "Classes/Hora.php";

class ParticiparView {
	function __construct($encuesta, $msg=NULL)
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
}
?>