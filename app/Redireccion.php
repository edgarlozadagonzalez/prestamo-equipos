<?php
Class Redireccion{

    public static function redirigir($url){
        header('Location: ' .$url, true, 301);
        exit();
    }
    public static function PaginaLogica()
    {   include_once 'config.php';
        include_once 'app/ControlSesion.php';
        if(ControlSesion::sesionIniciada()){
            if ($_SESSION['cod_rol']==$admin){
             Redireccion::redirigir(RUTA_ADMIN);
             } else {
                 Redireccion::redirigir(RUTA_HOME);
             }
         }
    }
  
}
?>