<?php
include_once 'app/config.php';
include_once 'app/Conexion.php';
include_once 'app/Redireccion.php';
include_once 'app/ControlSesion.php';
include_once 'app/Repositorios/RepositorioEquipo.php';

if (!ControlSesion::sesionIniciada()) {
    Redireccion::redirigir(RUTA_LOGIN);
} else if ($_SESSION['cod_rol'] == $admin) {
    Redireccion::redirigir(RUTA_ADMIN);
}

Conexion::abrirConexion();

$titulo = 'Centro TiC';

include_once 'plantillas/documento-declaracion.php';
include_once 'plantillas/navbar.php';


switch ($opcion_actual) {
    case '':
        ?> 
        <div id="equiposdisponibles"></div>
        <?php
    break;
    case 'devolverequipo':
        ?> 
        <div id="devolverequipo"></div>
        <?php
    break;
    case 'historialprestamo':
        ?> 
        <div id="historialprestamo"></div>
        <?php
    break;
    
}
Conexion::cerrarConexion();
include_once 'plantillas/documento-cierre.php';
?>

