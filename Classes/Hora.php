<?php
class Hora
{
	private $idEncuesta;
	private $horaInicio;
	private $horaFin;

	function __construct( $horaInicio, $horaFin)
	{
	$this->horaInicio = $horaInicio;
	$this->horaFin = $horaFin;
	}

	function getHoraInicio()
	{

		return $this->horaInicio;

	}

	function getHoraFin()
	{

		return $this->horaFin;

	}
}
?>