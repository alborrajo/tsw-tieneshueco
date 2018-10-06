<?php
include_once "Classes/Encuesta.php";


class PerfilView {
    function __construct($encuestas, $encuestasCompartidas, $msg=NULL) {
        ?>
        <main class="container">	
            <h3>Encuestas</h3>

            <ul class="list-group">
                <?php
                foreach($encuestas as $encuesta) {
                    ?>
                    <li class="list-group-item">
                        <a href="index.php?controller=encuesta&action=participarencuesta&id=<?php echo $encuesta->getID(); ?>">
                            <?php echo $encuesta->getNombre(); ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>

            <br>

            <?php if($msg != null) { //Mostrar alerta si la variable $msg está establecida ?>
            <div class="alert" role="alert">
                <?php echo $msg; ?>
            </div>       
            <?php } ?>

            <h3>Encuestas compartidas</h3>

            <ul class="list-group">
            <?php
                foreach($encuestasCompartidas as $encuestaCompartida) {
                    ?>
                    <li class="list-group-item">
                        <a href="poll=<?php echo $encuestaCompartida->getID(); ?>">
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