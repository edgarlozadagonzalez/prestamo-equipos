<?php
include_once '../app/config.php';
include_once '../app/Conexion.php';
include_once '../app/Repositorios/RepositorioPersona.php';
include_once '../app/Redireccion.php';

Redireccion::PaginaLogica();

$titulo = 'Registro realizado';

include_once '../plantillas/documento-declaracion.php';
include_once '../plantillas/navbar.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-ok.circle" aria-hidden="true"></span> Registro correcto
                </div>
                <div class="panel-body text-center">
                    <p>
                        ¡Hola <b><?php echo $pri_nombre ?></b> ! Tu registro se ha realizado satisfactoriamente.
                    </p>
                    <br>
                    <p><a href="<?php echo RUTA_LOGIN ?>"> Inicia Sesión</a> para usar tu cuenta</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once '../plantillas/documento-cierre.php';?>