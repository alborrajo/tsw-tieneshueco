<?php
class Login{
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
    <form action="../Controllers/login_controller.php" method="POST" name="formularioLogin">
        <h2 class="text-center">Iniciar Sesión</h2>       
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Correo electrónico" required="required" name="login">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Contraseña" required="required" name="password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" value="Login">Entrar</button>
        </div>
        <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox"> Recuerdame</label>
        </div>        
    </form>
    <p class="text-center"><a href="../Controllers/registro_controller.php">Registrarse</a></p>
</div>
	
	</main>

</body>
	<?php 
	include '../Views/footer-view.php';
    new Footer();
		
	}

}?>
