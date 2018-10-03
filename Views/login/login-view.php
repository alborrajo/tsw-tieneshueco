<?php
class LoginView{
	function __construct($msg=null){		
	?>		
<body>

	<main class="container">
<div class="login-form">
    <form action="/" method="POST" name="formularioLogin">
        <h2 class="text-center">Iniciar Sesión</h2>

        <?php if($msg != null) { //Mostrar alerta si la variable $msg está establecida ?>
            <div class="alert" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php } ?>

        <input type="hidden" name="action" value="login">

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Correo electrónico" required="required" name="email">
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
    <p class="text-center"><a href="/index.php?controller=login&action=register">Registrarse</a></p>
</div>
	
	</main>

</body>
	<?php 		
	}

}?>
