<?php
include_once "Classes/Encuesta.php";


class PerfilView {

    private $encuestas;
    private $encuestasCompartidas;
    private $msg;

    function __construct($encuestas, $encuestasCompartidas, $msg=NULL) {
        $this->encuestas = $encuestas;
        $this->encuestasCompartidas = $encuestasCompartidas;
        $this->msg = $msg;
    }

    function render() {
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
                    </li>
                    <?php
                }
                ?>
            </ul>

            <br>

            <?php if($this->msg != null) { //Mostrar alerta si la variable $msg está establecida ?>
            <div class="alert" role="alert">
                <?php echo $this->msg; ?>
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