<?php

class RegisterView{

	function __construct($msg=NULL){
	?>	

<body>

	<main class="container">
<div class="login-form">
    <form action="/" method="POST" name="formularioRegister">
        <h2 class="text-center">Registro</h2>

        <?php if($msg != null) { //Mostrar alerta si la variable $msg está establecida ?>
            <div class="alert" role="alert">
                <?php echo $msg; ?>
            </div>       
        <?php } ?>

        <input type="hidden" name="action" value="register">

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Correo electrónico" required="required" name="email">
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
	}
}
?>

