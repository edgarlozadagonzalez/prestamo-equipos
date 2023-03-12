<?php
class ControlSesion
{

    public static function iniciarSesion($id_usuario, $nombre_usuario, $cod_rol)
    {
        if( !headers_sent() && '' == session_id() ) {
            session_start();
        }
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        $_SESSION['cod_rol'] = $cod_rol;
    }
    public static function cerrarSesion()
    {
        if( !headers_sent() && '' == session_id() ) {
            session_start();
        }
        if (isset($_SESSION['id_usuario'])) {
            unset($_SESSION['id_usuario']);
        }
        if (isset($_SESSION['nombre_usuario'])) {
            unset($_SESSION['nombre_usuario']);
        }
        if (isset($_SESSION['cod_rol'])) {
            unset($_SESSION['cod_rol']);
        }
        session_destroy();
    }
    public static function sesionIniciada()
    {
        if( !headers_sent() && '' == session_id() ) {
            session_start();
        }
        if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombre_usuario']) && isset($_SESSION['cod_rol'])) {
            return true;
        } else {
            return false;
        }
    }
}
