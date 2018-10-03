<?php
include_once "../Classes/Encuesta.php";


class PerfilView {
    function __construct($encuestas, $encuestasCompartidas) {
        ?>
        <main class="container">	
            <h3>Encuestas</h3>

            <ul class="list-group">
                <?php
                foreach($encuestas as $encuesta) {
                    ?>
                    <li class="list-group-item">
                        <a href="action=showEncuesta&id=<?php echo $encuesta->getID(); ?>">
                            <?php echo $encuesta->getNombre(); ?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>

            <br>

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