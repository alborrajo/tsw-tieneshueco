<?php

class Registro{

	function __construct(){
		$this->toString();
	}

	function toString(){
		include '../Views/header-view.php';
        new Header();
	?>	

<body>

	<main class="container">
<div class="login-form">
    <form action="../Controllers/registro_controller.php" method="POST" name="formularioRegister">
        <h2 class="text-center">Registro</h2>       
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Correo electrónico" required="required" name="login">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Contraseña" required="required" name="password">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Nombre" required="required" name="nombre">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" value="Registro">Registrar</button>
        </div>       
    </form>
</div>
	
	</main>




</body>
<?php
 include '../Views/footer-view.php';
 new Footer();

	}
}
?>

