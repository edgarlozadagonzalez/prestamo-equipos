<?php
include_once '../Conexion.php'; 
include_once '../Conexion.php';	
include_once '../Repositorios/RepositorioRol.php';
include_once "../Entidades/Rol.php";
Conexion::abrirConexion();

if(isset($_POST['cod_rolE'])){
    RepositorioRol::eliminarRol(Conexion::obtenerConexion(),$_POST['cod_rolE']); 
}else if(isset($_POST['nombre_rol'])){
    $rol = new Rol('',$_POST['nombre_rol']);
    if(!RepositorioRol::NombreRolexiste(Conexion::obtenerConexion(),$rol->obtenerNombre_rol())){
    RepositorioRol::insertarRol(Conexion::obtenerConexion(),$rol);
    }
}else if(isset($_POST['cod_rolU'])){
    $rol = new Rol($_POST['cod_rolU'],$_POST['nombre_rolU']);
    if(!RepositorioRol::NombreRolexiste(Conexion::obtenerConexion(),$rol->obtenerNombre_rol())){
     RepositorioRol::actualizarRol(Conexion::obtenerConexion(),$rol);
    }
}
Conexion::cerrarConexion();