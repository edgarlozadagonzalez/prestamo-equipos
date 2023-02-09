<?php
include_once 'app/ControlSesion.php';
include_once 'app/Redireccion.php';
include_once 'app/config.php';
ControlSesion::cerrarSesion();
Redireccion::redirigir(RUTA_LOGIN);

?>