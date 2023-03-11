<?php
$componentes_url = parse_url($_SERVER["REQUEST_URI"]);
$ruta = $componentes_url['path'];
$partes_ruta = explode("/", $ruta);
$partes_ruta = array_filter($partes_ruta);
$partes_ruta = array_slice(($partes_ruta), 0);
if (count($partes_ruta) == 0) {
    $ruta_elegida = 'vistas/login.php';
    echo $ruta_elegida;
    $cantidad = count($partes_ruta);
    echo $cantidad;
    print_r($partes_ruta);
} else if (count($partes_ruta) > 0) {
    echo $ruta_elegida;
    print_r($partes_ruta);
    switch ($partes_ruta[0]) {
        case 'home':
            $ruta_elegida = 'vistas/home.php';
            break;
        case 'login':
            $ruta_elegida = 'vistas/login.php';
            break;
        case 'logout':
            $ruta_elegida = 'vistas/logout.php';
            break;
        case 'registro':
            $ruta_elegida = 'vistas/registro.php';
            break;
        case 'admin':
            $ruta_elegida = 'vistas/admin.php';
            $gestor_actual = '';
            break;
    }
} else if (count($partes_ruta) == 2) {
    switch ($partes_ruta[0]) {
        case 'registroOK':
            $pri_nombre = $partes_ruta[1];
            $ruta_elegida = 'vistas/registroOK.php';
            break;
        case 'admin':
            switch ($partes_ruta[1]) {
                case 'roles':
                    $gestor_actual = 'roles';
                    $ruta_elegida = 'vistas/admin.php';
                    break;
                case 'salas':
                    $gestor_actual = 'salas';
                    $ruta_elegida = 'vistas/admin.php';
                    break;
                case 'edificios':
                    $gestor_actual = 'edificios';
                    $ruta_elegida = 'vistas/admin.php';
                    break;
                case 'equipos':
                    $gestor_actual = 'equipos';
                    $ruta_elegida = 'vistas/admin.php';
                    break;
                case 'prestamos':
                    $gestor_actual = 'prestamos';
                    $ruta_elegida = 'vistas/admin.php';
                    break;
                case 'facultades':
                    $gestor_actual = 'facultades';
                    $ruta_elegida = 'vistas/admin.php';
                    break;
                case 'dispositivos':
                    $gestor_actual = 'dispositivos';
                    $ruta_elegida = 'vistas/admin.php';
                    break;
                case 'personas':
                    $gestor_actual = 'personas';
                    $ruta_elegida = 'vistas/admin.php';
                    break;
                case 'historial':
                    $gestor_actual = 'historial';
                    $ruta_elegida = 'vistas/admin.php';
                    break;
                case 'prestamosactivos':
                    $gestor_actual = 'prestamosactivos';
                    $ruta_elegida = 'vistas/admin.php';
                    break;
                case 'equiposaveriados':
                    $gestor_actual = 'equiposaveriados';
                    $ruta_elegida = 'vistas/admin.php';
                    break;
            }
            break;
        case 'home':
            switch ($partes_ruta[1]) {
                case 'devolverequipo':
                    $opcion_actual = 'devolverequipo';
                    $ruta_elegida = 'vistas/home.php';
                    break;
                case 'historialprestamo':
                    $opcion_actual = 'historialprestamo';
                    $ruta_elegida = 'vistas/home.php';
                    break;
            }
            break;
    }
}
include_once $ruta_elegida;
