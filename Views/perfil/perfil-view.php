<?php
include_once "Classes/Encuesta.php";
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
        ?>
        <main class="container">	
            <h3>Encuestas</h3>

            <ul class="list-group">
                <?php
                foreach($this->encuestas as $encuesta) {
                    ?>
                    <li class="list-group-item">
                        <a href="index.php?controller=encuesta&action=participarencuesta&id=<?php echo $encuesta->getID(); ?>">
                            <?php echo $encuesta->getNombre(); ?>
                        </a>

                        <!-- TODO: Meter boton de verdad -->
                        <a href="index.php?controller=encuesta&action=editencuesta&id=<?php echo $encuesta->getID(); ?>">
                            EDIT
                        </a>

                        <!-- TODO: Meter boton de verdad -->
                        <form action="/index.php" method="post">
                            <input type="hidden" name="controller" value="perfil">
                            <input type="hidden" name="action" value="delEncuesta">
                            <input type="hidden" name="id" value="<?php echo $encuesta->getID(); ?>">
                            <input type="submit" value="DELETE">
                        </form>
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

            <h3>Encuestas compartidas</h3>

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