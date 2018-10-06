<?php

class Voto
{

private $usuario;
private $idEncuesta;
private $fecha;
private $horaInicio;
private $horaFin;

	function __construct($usuario, $idEncuesta, $fecha, $horaInicio, $horaFin)
	{
		$this->usuario = $usuario;
		$this->idEncuesta = $idEncuesta;
		$this->fecha = $fecha;
		$this->horaInicio = $horaInicio;
		$this->horaFin = $horaFin;
	}
}
?>