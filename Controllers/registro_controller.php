<?php

session_start();
if(isset($_SESSION['login'])){
		header('Location:../index.php');
}

function get_data_form(){

	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'];
	$Nombre = $_REQUEST['Nombre'];
	

	$usuario = new Usuario($login, $password, $DNI, $Nombre, $Apellidos, $Correo, $Direccion, $Telefono);
 
	return $usuario;
}

if(!$_POST){//Si no se ha llegado mediante el formulario de vistaRegistro
	include '../Views/Registro.php';//Incluir vistaRegistro
	new Registro();//Mostrar vistaRegistro	
}else{//Sino
	header('Location:../Controllers/perfil-controller.php');
}
?>