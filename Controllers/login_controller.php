<?php
session_start();
if(isset($_SESSION['login'])){
		header('Location:../index.php');
	}

if(!isset($_REQUEST['login']) && (!isset($_REQUEST['password']))){//Si no se ha llegado mediante el formulario de vistaLogin
	include '../Views/Login.php';//Incluir vistaLogin
	new Login();//Mostrar vistaLogin
}else{//Sino
	if($_REQUEST['login'] == "login" && $_REQUEST['password'] == "password"){//Si se ha encontrado ese login con esa contraseña
		session_start();
		$_SESSION['login'] = $_REQUEST['login'];//Inicializar session login a lo enviado
		header('Location: ../index.php');//Ahora que se ha logeado se vuelve al index
	}else{//Sino
		echo "Error, usuario no identificado";//Mednsaje que ha dado la consulta en la BD
	}
}
?>