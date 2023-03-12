<?php
include_once '../Conexion.php'; 
include_once '../Conexion.php';	
include_once '../Repositorios/RepositorioFacultad.php';
include_once "../Entidades/Facultad.php";
Conexion::abrirConexion();

if(isset($_POST['cod_facE'])){
    RepositorioFacultad::eliminarFacultad(Conexion::obtenerConexion(),$_POST['cod_facE']); 
}else if(isset($_POST['nombre_fac'])){
    $facultad = new Facultad('',$_POST['nombre_fac']);
    if(!RepositorioFacultad::NombreFacultadexiste(Conexion::obtenerConexion(),$facultad->obtenerNombre_fac())){
    RepositorioFacultad::insertarFacultad(Conexion::obtenerConexion(),$facultad);
    }
}else if(isset($_POST['cod_facU'])){
    $facultad = new Facultad($_POST['cod_facU'],$_POST['nombre_facU']);
    if(!RepositorioFacultad::NombreFacultadexiste(Conexion::obtenerConexion(),$facultad->obtenerNombre_fac())){
    RepositorioFacultad::actualizarFacultad(Conexion::obtenerConexion(),$facultad);
    }
}
Conexion::cerrarConexion();