<?php
include_once '../Conexion.php';
include_once '../Conexion.php';
include_once '../Repositorios/RepositorioEquipo.php';
include_once "../Entidades/Equipo.php";
Conexion::abrirConexion();

if (isset($_POST['cod_equE'])) {
    RepositorioEquipo::eliminarEquipo(Conexion::obtenerConexion(), $_POST['cod_equE']);
} else if (isset($_POST['cod_equ']) && !isset($_POST['cod_equU'])) {
    $equipo = new Equipo($_POST['cod_equ'], $_POST['marca'], $_POST['valor'], $_POST['estado'], $_POST['descripcion'], $_POST['cod_sal'], $_POST['cod_disp']);
    if (RepositorioEquipo::cod_equExiste(Conexion::obtenerConexion(), $equipo->obtenerCod_equ())) {
    } else {
        RepositorioEquipo::insertarEquipo(Conexion::obtenerConexion(), $equipo);
    }
} else if (isset($_POST['cod_equU'])) {
    $equipo = new Equipo($_POST['cod_equU'], $_POST['marcaU'], $_POST['valorU'], $_POST['estadoU'], $_POST['descripcionU'], $_POST['cod_salU'], $_POST['cod_dispU']);
    if ($_POST['cod_equ'] !== $_POST['cod_equU']) {
        if (RepositorioEquipo::cod_equExiste(Conexion::obtenerConexion(), $equipo->obtenerCod_equ())) {
            echo 'El serial de este equipo ya se encuentra registrado';
        } else {
            RepositorioEquipo::actualizarEquipo(Conexion::obtenerConexion(), $equipo, $_POST['cod_equ']);
        }
    }else {
        RepositorioEquipo::actualizarEquipo(Conexion::obtenerConexion(), $equipo, $_POST['cod_equ']);
    }
}
Conexion::cerrarConexion();
?>