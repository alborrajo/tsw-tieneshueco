<?php
include_once "Classes/Encuesta.php";
include_once "Views/plantilla-view.php";


class MSGView extends PlantillaView {

    private $msgException;

    function __construct($msgException,$logeado=false) {
        $this->msgException = $msgException;
        parent::__construct($logeado);
    }

    function _render() {
        ?>
        <main class="container">	
            <div class="alert alert-<?php echo $this->msgException->getStatus(); ?>" role="alert">
                <?php echo $this->msgException->getMessage(); ?>
            </div>
        </main>
        <?php
    }

}