<?php
//IMPORTANTE: Este header SOLO se debe mostrar CUANDO EL USUARIO HA INICIADO SESION
//Si no ha iniciado sesión, se deberá mostrar otro header SIN BOTONES DE CREAR ENCUESTA, ENCUESTAS Y CERRAR SESIÓN

class Header {
    function __construct() {
        ?>
        <!DOCTYPE html>
        <html>
            <head> 
                <meta charset="UTF-8">

                <!--bootstap advices -->
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
                <link rel="stylesheet" href="../estilo.css" type="text/css"/>
                
                <title>Tieneshueco?</title>
            </head>

            <body>
                <div class="container-fluid">
                            
                    <header>
                            <div id="topdiv" class="row">
                                <div id="logotipo" class="col-8" >
                                    <img src="../images/logotipo.png" alt="logotipo" width="64" height="64"/>
                                    <a href="" class=" enlace"> Ayuda </a>
                                    <a href="" class="enlace"> Español </a>
                                </div>
                                <nav class="col-4 navegadorsuperior">
                                    <a href="" class=" enlace" data-toggle="modal" data-target="#crearEncuestaModal"> Crear encuesta </a>
                                    <a href="" class=" enlace"> Encuestas </a>
                                    <a href="" class=" enlace"> Cerrar sesión </a>
                                </nav>
                            </div>
                    </header>

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
                                <form method="post" action="/Controllers/perfil-controller.php">
                                    <div class="modal-body">
                                        <input type="hidden" name="action" value="nuevaEncuesta">
                                        Nombre: <input type="text" name="nombre">
                                    </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" value="Crear">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <br/>
        <?php
    }
}
?>