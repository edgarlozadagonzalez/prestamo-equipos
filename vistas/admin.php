<?php
include_once 'app/config.php';
include_once 'app/Conexion.php';
include_once 'app/Repositorios/RepositorioSala.php';
include_once 'app/Redireccion.php';
include_once 'app/ControlSesion.php';

if(!ControlSesion::sesionIniciada()){
    Redireccion::redirigir(RUTA_LOGIN);
}else if($_SESSION['cod_rol']!==$admin){
    Redireccion::redirigir(RUTA_HOME);
}

$titulo = 'Admin TiC';

include_once 'plantillas/documento-declaracion.php';
include_once 'plantillas/navbar.php';
include_once 'plantillas/panel-control-declaracion.php';

Conexion::abrirConexion();
switch ($gestor_actual) {
    case '':
        $cantidad_salas = RepositorioSala::Contar(Conexion::obtenerConexion(),"SELECT COUNT(*) as total FROM salas");
        $salas_windows = RepositorioSala::Contar(Conexion::obtenerConexion(),"SELECT COUNT(plataforma) as total FROM salas WHERE plataforma LIKE'Windows%'");
        $salas_sede = RepositorioSala::Contar(Conexion::obtenerConexion(),"SELECT COUNT(*) as total FROM salas as sa WHERE sa.cod_edif IN (SELECT cod_edif FROM edificios WHERE sede LIKE'Barcelona')");
        $cantidad_equipos = RepositorioSala::Contar(Conexion::obtenerConexion(),"SELECT COUNT(*) as total FROM equipos");
        $bnestado_equipos = RepositorioSala::Contar(Conexion::obtenerConexion(),"SELECT COUNT(*) as total FROM equipos WHERE estado = 't'");
        $cantidad_pc= RepositorioSala::Contar(Conexion::obtenerConexion(),"SELECT COUNT(*) as total FROM equipos as eq WHERE eq.cod_disp IN (SELECT cod_disp FROM dispositivos WHERE nombre_disp LIKE'PC')");
        $cantidad_prestamos= RepositorioSala::Contar(Conexion::obtenerConexion(),"SELECT COUNT(*) as total FROM prestamos");
        $cantidad_sinentregar= RepositorioSala::Contar(Conexion::obtenerConexion(),"SELECT COUNT(*) as total FROM prestamos WHERE fecha_fin is null");
        $cantidad_entregado= RepositorioSala::Contar(Conexion::obtenerConexion(),"SELECT COUNT(*) as total FROM prestamos WHERE fecha_fin is not null");
        include_once 'gestores/gestor-generico.php';
    break;
    case 'roles':
        ?> 
        <div id="roles"></div>
        <?php
    break;
    case 'salas':
        ?> 
        <div id="salas"></div>
        <?php
    break;
    case 'edificios':
        ?> 
        <div id="edificios"></div>
        <?php
    break;
    case 'equipos':
        ?> 
        <div id="equipos"></div>
        <?php
    break;
    case 'facultades':
        ?> 
        <div id="facultades"></div>
        <?php
    break;
    case 'dispositivos':
        ?> 
        <div id="dispositivos"></div>
        <?php
    break;
    case 'prestamos':
        ?> 
        <div id="prestamos"></div>
        <?php
    break;
    case 'personas':
        ?> 
        <div id="personas"></div>
        <?php
    break;
    case 'historial':
        ?> 
        <div id="historial"></div>
        <?php
    break;
    case 'prestamosactivos':
        ?> 
        <div id="prestamosactivos"></div>
        <?php
    break;
    case 'equiposaveriados':
        ?> 
        <div id="equiposaveriados"></div>
        <?php
    break;
}
Conexion::cerrarConexion();
include_once 'plantillas/panel-control-cierre.php';
include_once 'plantillas/documento-cierre.php';
?>

