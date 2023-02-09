<?php
include_once '../Conexion.php';
include_once '../Conexion.php';
include_once '../Repositorios/RepositorioDispositivo.php';
include_once "../Entidades/Dispositivo.php";
Conexion::abrirConexion();

if (isset($_POST['cod_dispE'])) {
    RepositorioDispositivo::eliminarDispositivo(Conexion::obtenerConexion(), $_POST['cod_dispE']);
} else if (isset($_POST['nombre_disp'])) {
    $dispositivo = new Dispositivo('', $_POST['nombre_disp']);
    if (!RepositorioDispositivo::NombreDispositivoexiste(Conexion::obtenerConexion(), $dispositivo->obtenerNombre_disp())) {
        RepositorioDispositivo::insertarDispositivo(Conexion::obtenerConexion(), $dispositivo);
    }
} else if (isset($_POST['cod_dispU'])) {
    $dispositivo = new Dispositivo($_POST['cod_dispU'], $_POST['nombre_dispU']);
    if (!RepositorioDispositivo::NombreDispositivoexiste(Conexion::obtenerConexion(), $dispositivo->obtenerNombre_disp())) {
        RepositorioDispositivo::actualizarDispositivo(Conexion::obtenerConexion(), $dispositivo);
    }
}
Conexion::cerrarConexion();
