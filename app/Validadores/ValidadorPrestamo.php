<?php
include_once '../config.php';
include_once '../Conexion.php';
include_once '../Repositorios/RepositorioPrestamo.php';
include_once '../Repositorios/RepositorioPersona.php';
include_once '../Repositorios/RepositorioEquipo.php';
include_once '../Entidades/Prestamo.php';
include_once '../ControlSesion.php';
Conexion::abrirConexion();
//Insertar
if (isset($_POST['cod_equ']) && isset($_POST['cod_per'])) {
    date_default_timezone_set("America/Bogota");
    $fecha_inicio = date('Y-m-d H:i:s');
    $prestamo = new Prestamo('', $fecha_inicio, '', $_POST['cod_per'], $_POST['cod_equ']);
    $insertado = RepositorioPrestamo::insertarPrestamo(Conexion::obtenerConexion(), $prestamo, 0);
}
//Finalizar
if (isset($_POST['cod_equD']) && isset($_POST['cod_pres'])) {
    date_default_timezone_set("America/Bogota");
    $fecha_fin = date('Y-m-d H:i:s');
    ControlSesion::sesionIniciada();
    $finalizado = RepositorioPrestamo::finalizarPrestamo(Conexion::obtenerConexion(), $_POST['cod_pres'], $_POST['cod_equD'], $_SESSION['id_usuario'], $fecha_fin, 1);
}

//Eliminar
if (isset($_POST['cod_presE'])) {
    $eliminado = RepositorioPrestamo::eliminarPrestamo(Conexion::obtenerConexion(), $_POST['cod_presE']);
    if ($eliminado == 1) {
        RepositorioEquipo::actualizarEstado(Conexion::obtenerConexion(), $_POST['cod_equ'], 1);
    }
}

//Actualizar
if (isset($_POST['cod_presU'])) {
    $personaexisteU = 0;
    if ($personaexisteU == RepositorioPersona::cod_perExiste(Conexion::obtenerConexion(), $_POST['cod_perU'])) {
        echo 'El numero de identificacion de la persona no existe';
    } else if (!RepositorioEquipo::cod_equExiste(Conexion::obtenerConexion(), $_POST['cod_equU'])) {
        echo 'El serial del equipo no existe';
    } else {
        if (empty($_POST['fecha_finU'])) {
            $prestamo = new Prestamo($_POST['cod_presU'], $_POST['fecha_inicioU'], null, $_POST['cod_perU'], $_POST['cod_equU']);
            if (RepositorioPrestamo::actualizarPrestamo(Conexion::obtenerConexion(), $prestamo)) {
                echo RepositorioEquipo::actualizarEstado(Conexion::obtenerConexion(), $prestamo->obtenerCod_equ(), 0);
            }
        } else {
            $prestamo = new Prestamo($_POST['cod_presU'], $_POST['fecha_inicioU'], $_POST['fecha_finU'], $_POST['cod_perU'], $_POST['cod_equU']);
            if (RepositorioPrestamo::actualizarPrestamo(Conexion::obtenerConexion(), $prestamo)) {
                RepositorioPrestamo::actualizarHistorial(Conexion::obtenerConexion(), $prestamo->obtenerCod_pres(), $prestamo->obtenerCod_equ(), $prestamo->obtenerCod_per(), $prestamo->obtenerFecha_fin(), 1);
            }
        }
    }
}


//AGREGAR
if (isset($_POST['cod_equA'])) {
    $personaexiste = 0;
    if ($personaexiste == RepositorioPersona::cod_perExiste(Conexion::obtenerConexion(), $_POST['cod_per'])) {
        echo 'El numero de identificacion de la persona no existe';
    } else if (!RepositorioEquipo::cod_equExiste(Conexion::obtenerConexion(), $_POST['cod_equA'])) {
        echo 'El serial del equipo no existe';
    } else {
        $prestamo = new Prestamo('', $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['cod_per'], $_POST['cod_equA']);
        $estado = RepositorioEquipo::obtenerEstadoequipo(Conexion::obtenerConexion(), $prestamo->obtenerCod_equ());
        if (empty($_POST['fecha_fin'])) {
            if ($estado['estado'] == 0) {
                echo 'El equipo no se encuentra disponible';
            } else {
                echo RepositorioPrestamo::insertarPrestamoAdmin(Conexion::obtenerConexion(), $prestamo, 0);
            }
        } else {
            if ($estado['estado'] == 0) {
                echo 'El equipo no se encuentra disponible';
            } else if (RepositorioPrestamo::insertarPrestamoAdmin(Conexion::obtenerConexion(), $prestamo, 1)) {

                $datosprestamo = RepositorioPrestamo::obtenerCodprestamo(Conexion::obtenerConexion(), $prestamo);
                RepositorioPrestamo::finalizarPrestamo(Conexion::obtenerConexion(), $datosprestamo->obtenerCod_pres(), $datosprestamo->obtenerCod_equ(), $datosprestamo->obtenerCod_per(), $datosprestamo->obtenerFecha_fin(), 1);
            }
        }
    }
}
Conexion::cerrarConexion();
