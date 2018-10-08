<?php
include_once "Classes/Encuesta.php";


class EditarView {

	private $encuesta;
	private $msg;

	function __construct($encuesta, $msg=NULL)
	{
		?>

		<main class= "container">
			<div id="divdescripcion">
			<p> Ahora podrás editar tu encuesta, decide entre que días estará la votación y envía el enlace generado para que la gente empiece a votar. </p>
			<br/>
			<em> Edita tu encuesta. </em>
			</div>

			<form action="/" method="POST" name="formularioencuesta">

				<input type="hidden" name="action" value="edit">

				<div id="encuesta" class="row">
					<table class="table-borderer col-10">

						<tr>
							<th>

							</th>
						<?php
						$fechas = $encuesta->fechas;
						foreach($fechas as $fecha)
						{
							?>
							<td>
								<input type="button" value="Eliminar columna">
							</td>
							<?php
						}
						?>
						</tr>

						<tr>
							<th>

							</th>
						<?php
						$fechas = $encuesta->fechas;
						foreach($fechas as $fecha)
						{
							?>
							<td>
								<?php echo $fecha->fechas;?>
							</td>
							<?php
						}
						?>
						</tr>
					</table>

					<input type="button" class="col-2" value="Nueva columna">
				</div>

				<div class="linkencuesta">

					<p> Este es el link de tu encuesta: </p>
					<input type="text" readonly="readonly" size="50" value=<?php echo $encuesta->getID()?> >
					<p> Compártelo para que la gente empiece a votar.</p>

		<?php if($msg != null) { //Mostrar alerta si la variable $msg está establecida ?>
            <div class="alert" role="alert">
                <?php echo $msg; ?>
            </div>       
        <?php } ?>
        </main>
        <?php
    }
}?>