<?php
include_once "Classes/Encuesta.php";
include_once "Classes/MSGException.php";

include_once "Views/plantilla-view.php";


class PerfilView extends PlantillaView {
    
    private $encuestas;
    private $encuestasCompartidas;
    private $msgException;

    function __construct($encuestas, $encuestasCompartidas, $msgException=NULL) {
        $this->encuestas = $encuestas;
        $this->encuestasCompartidas = $encuestasCompartidas;
        $this->msgException = $msgException;
        parent::__construct(true);
    }

    function _render() {
        include "Locale/en.php";
        if(isset($_SESSION["locale"])) {
            include "Locale/".$_SESSION["locale"].".php";
        }
        ?>
        <main class="container">	
            <h3><?php echo $strings["Polls"]; ?></h3>

            <ul class="list-group">
                <?php
                foreach($this->encuestas as $encuesta) {
                    ?>
                    <li class="list-group-item">
                        <a href="index.php?controller=encuesta&action=participarencuesta&id=<?php echo $encuesta->getID(); ?>">
                            <?php echo $encuesta->getNombre(); ?>
                        </a>

                        <div class="pull-right">
                            <form class="d-inline" action="/index.php" method="get">
                                <input type="hidden" name="controller" value="encuesta">
                                <input type="hidden" name="action" value="editencuesta">
                                <input type="hidden" name="id" value="<?php echo $encuesta->getID(); ?>">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-pen-square"></i></button>
                            </form>

                            <form class="d-inline" action="/index.php" method="post">
                                <input type="hidden" name="controller" value="perfil">
                                <input type="hidden" name="action" value="delEncuesta">
                                <input type="hidden" name="id" value="<?php echo $encuesta->getID(); ?>">
                                <button type="submit" class="btn btn-danger"><i class="fas fa-minus-square"></i></button>
                            </form>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>

            <br>

            <?php if($this->msgException != null) { //Mostrar alerta si la variable $msg está establecida ?>
            <div class="alert alert-<?php echo $this->msgException->getStatus(); ?>" role="alert">
                <?php echo $this->msgException->getMessage(); ?>
            </div>     
            <?php } ?>

            <h3><?php echo $strings["SharedPolls"]; ?></h3>

            <ul class="list-group">
            <?php
                foreach($this->encuestasCompartidas as $encuestaCompartida) {
                    ?>
                    <li class="list-group-item">
                        <a href="index.php?controller=encuesta&action=participarencuesta&id=<?php echo $encuestaCompartida->getID(); ?>">
                            <?php echo $encuestaCompartida->getNombre(); ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </main>
        <?php
    }

}