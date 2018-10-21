<?php
include_once "Views/plantilla-view.php";

class LoginView extends PlantillaView {

    private $msg;

	function __construct($msg=null){		
        $this->msg = $msg;
        parent::__construct();
    }
    
    function _render() {
                ?>		
        <body>

            <main class="container">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-lg login-form">
                        <form action="/" method="POST" name="formularioLogin">
                            <h2 class="text-center">Iniciar Sesión</h2>

                            <?php if($this->msg != null) { //Mostrar alerta si la variable $msg está establecida ?>
                                <div class="alert alert-primary" role="alert">
                                    <?php echo $this->msg; ?>
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
                    <div class="col"></div>
                </div>
                    
            </main>

        </body>
            <?php 		
    }

}?>
