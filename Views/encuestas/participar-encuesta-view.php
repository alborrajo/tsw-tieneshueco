<?php
include_once "../../Classes/Encuesta.php";




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
				<?php
				$fechas = $encuesta->getFechas();
					foreach($fechas as $fecha)
					{
						?>
						<th>
							<?php echo $fecha->getFecha();?>
						</th>
					}
					?>
				</tr>

				<?php //TODO: Insertar las filas con los participantes en la encuesta 
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
}
}?>