<?php
include_once '../Conexion.php';
include_once '../Conexion.php';
include_once "../Entidades/Edificio.php";
include_once '../Repositorios/RepositorioEdificio.php';
Conexion::abrirConexion();

if (isset($_POST['cod_edifE'])) {
    RepositorioEdificio::eliminarEdificio(Conexion::obtenerConexion(), $_POST['cod_edifE']);
} else if (isset($_POST['nombre_edif'])) {
    $edificio = new Edificio('', $_POST['nombre_edif'], $_POST['num_pisos'], $_POST['sede']);
    if(!RepositorioEdificio::NombreEdificioexiste(Conexion::obtenerConexion(), $edificio->obtenerNombre_edif())){
        RepositorioEdificio::insertarEdificio(Conexion::obtenerConexion(), $edificio);
    }
} else if (isset($_POST['cod_edifU'])) {
    $edificio = new Edificio($_POST['cod_edifU'], $_POST['nombre_edifU'], $_POST['num_pisosU'], $_POST['sedeU']);
    if ($_POST['nombre_edifC'] !== $_POST['nombre_edifU']) {
        if (!RepositorioEdificio::NombreEdificioexiste(Conexion::obtenerConexion(), $edificio->obtenerNombre_edif())) {
            RepositorioEdificio::actualizarEdificio(Conexion::obtenerConexion(), $edificio);
        }
    } else {
        RepositorioEdificio::actualizarEdificio(Conexion::obtenerConexion(), $edificio);
    }
}
Conexion::cerrarConexion();
