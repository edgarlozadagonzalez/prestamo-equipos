<?php
include_once '../Conexion.php';
include_once '../Conexion.php';
include_once '../ControlSesion.php';
include_once '../Repositorios/RepositorioPersona.php';
include_once '../Repositorios/RepositorioEquipo.php';
Conexion::abrirConexion();
ControlSesion::sesionIniciada();
if (isset($_POST['cod_perE'])) {
    if ($_POST['cod_perE'] == $_SESSION['id_usuario']) {
        echo 'No puede eliminar al usuario dueño de la session actual';
    } else if (count(RepositorioEquipo::equiposSindevolver(Conexion::obtenerConexion(), $_POST['cod_perE']))) {
        echo 'No se puede eliminar. Esta persona tiene prestamos activos';
    } else {
        RepositorioPersona::eliminarPersona(Conexion::obtenerConexion(), $_POST['cod_perE']);
    }
}
Conexion::cerrarConexion();
?>