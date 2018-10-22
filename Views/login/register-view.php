<?php
include_once "Views/plantilla-view.php";


class RegisterView extends PlantillaView {

    private $msg;

	function __construct($msg=NULL){
        $this->msg = $msg;
        parent::__construct();
    }

    function _render() {
        include "Locale/en.php";
        if(isset($_SESSION["locale"])) {
            include "Locale/".$_SESSION["locale"].".php";
        }
	?>

<body>

    <main class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-lg login-form">
                <form action="/" method="POST" name="formularioRegister">
                    <h2 class="text-center">
                        <?php echo $strings["RegisterForm"]; ?>
                    </h2>

                    <?php if($this->msg != null) { //Mostrar alerta si la variable $msg está establecida ?>
                    <div class="alert alert-primary" role="alert">
                        <?php echo $this->msg; ?>
                    </div>
                    <?php } ?>

                    <input type="hidden" name="action" value="register">

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="<?php echo $strings["Email"]; ?>"
                        required="required" name="email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="<?php echo $strings["Password"]; ?>"
                        required="required" name="password">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="<?php echo $strings["Name"]; ?>"
                        required="required" name="nombre">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" value="Registro">
                            <?php echo $strings["Register"]; ?></button>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </main>




</body>
<?php
	}
}
?>