<?php
include_once '../Conexion.php'; 
include_once '../Conexion.php';	
include_once '../Repositorios/RepositorioSala.php';
include_once "../Entidades/Sala.php";
Conexion::abrirConexion();

if(isset($_POST['cod_salE'])){
    RepositorioSala::eliminarSala(Conexion::obtenerConexion(),$_POST['cod_salE']); 
}else if(isset($_POST['nombre_sal'])){
    $sala = new Sala('',$_POST['nombre_sal'], $_POST['num_piso'], $_POST['plataforma'], $_POST['cod_edif']);
    if(!RepositorioSala::NombreSalaexiste(Conexion::obtenerConexion(),$sala->obtenerNombre_sal())){
    RepositorioSala::insertarSala(Conexion::obtenerConexion(),$sala);
    }
}else if(isset($_POST['cod_salU'])){
    $sala = new Sala($_POST['cod_salU'],$_POST['nombre_salU'], $_POST['num_pisoU'], $_POST['plataformaU'], $_POST['cod_edifU']);
    if($_POST['nombre_salC'] !== $_POST['nombre_salU']){
    if(!RepositorioSala::NombreSalaexiste(Conexion::obtenerConexion(),$sala->obtenerNombre_sal())){
    RepositorioSala::actualizarSala(Conexion::obtenerConexion(),$sala);
        }
    }else{
        RepositorioSala::actualizarSala(Conexion::obtenerConexion(),$sala);
    }
}
Conexion::cerrarConexion();
