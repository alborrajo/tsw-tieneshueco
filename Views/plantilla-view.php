<?php
//IMPORTANTE: Este header SOLO se debe mostrar CUANDO EL USUARIO HA INICIADO SESION
//Si no ha iniciado sesión, se deberá mostrar otro header SIN BOTONES DE CREAR ENCUESTA, ENCUESTAS Y CERRAR SESIÓN

abstract class PlantillaView {

    private $logeado;

    function __construct($logeado=false) {
        $this->logeado = $logeado;
    }

    function render() {
        ?>
        <!DOCTYPE html>
        <html>
            <head> 
                <meta charset="UTF-8">

                <!--bootstap advices -->
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
                
                <!--<link rel="stylesheet" href="../estilo.css" type="text/css"/>-->
                
                <title>Tieneshueco?</title>
            </head>

            <body>    
                                    
                <nav class="navbar navbar-light bg-light">
                    <a href="/" class="float-left" href="#">
                        <img src="../images/logotipo.png" alt="logotipo" width="32" height="32" class="d-inline-block"/>
                        TienesHueco
                    </a>
                    
                    <?php if($this->logeado) { //Mostrar solo si el usuario está logeado ?>
                    <div class="btn-group float-right">
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#crearEncuestaModal"><i class="fas fa-calendar-plus"></i></a>
                        <a href="/index.php?controller=perfil" class="btn btn-default"><i class="fas fa-list"></i></a>
                        <a href="/index.php?controller=login&action=logout" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i></a>
                    </div>
                    <?php } ?>
                </nav>

                <!-- Modal de crear encuesta -->
                <div class="modal" id="crearEncuestaModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Nueva encuesta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/index.php" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="controller" value="perfil">
                                    <input type="hidden" name="action" value="nuevaEncuesta">
                                    Nombre: <input type="text" name="nombre">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Crear">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php $this->_render(); ?>

                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

            </body>

        </html>
        <?php
    }

    abstract protected function _render();
}
?>