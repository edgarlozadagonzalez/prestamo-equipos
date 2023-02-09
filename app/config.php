<?php 

// INFORMACIÓN DE LA BASE DE DATOS EN POSTGRESQL
define('NOMBRE_SERVIDOR', 'containers-us-west-199.railway.app');
define('NOMBRE_USUARIO', 'postgres');
define('PASSWORD', 'X8dcgivVa01sjaiw4f95');
define('BASE_DE_DATOS', 'railway');

//NUMERO IDENTIFICADOR DEL ADMINISTRADOR
$admin=1;

//rutas de la web
define("SERVIDOR","https://prestamo-equipos-production.up.railway.app/");
define("RUTA_LOGIN",SERVIDOR."/login");
define("RUTA_REGISTRO",SERVIDOR."/registro");
define("RUTA_REGISTRO_CORRECTO",SERVIDOR."/registroOK");
define("RUTA_LOGOUT",SERVIDOR."/logout");
define("RUTA_HOME",SERVIDOR."/home");
define("RUTA_SALAS",SERVIDOR."/salas");
define("RUTA_ADMIN",SERVIDOR."/admin");
define("RUTA_EQUIPOS",SERVIDOR."/equipos");
define("RUTA_CONTACTO",SERVIDOR."/contacto");
define("RUTA_GESTOR_SALAS",RUTA_ADMIN."/salas");
define("RUTA_GESTOR_EQUIPOS",RUTA_ADMIN."/equipos");
define("RUTA_GESTOR_PRESTAMOS",RUTA_ADMIN."/prestamos");
define("RUTA_GESTOR_ROL",RUTA_ADMIN."/roles");
define("RUTA_GESTOR_FACULTAD",RUTA_ADMIN."/facultades");
define("RUTA_GESTOR_DISPOSITIVO",RUTA_ADMIN."/dispositivos");
define("RUTA_GESTOR_EDIFICIO",RUTA_ADMIN."/edificios");
define("RUTA_DEVOLUCION",RUTA_HOME."/devolverequipo");
define("RUTA_HISTORIAL_PRESTAMO",RUTA_HOME."/historialprestamo");
define("RUTA_GESTOR_PERSONAS",RUTA_ADMIN."/personas");
define("RUTA_HISTORIAL",RUTA_ADMIN."/historial");
define("RUTA_PRESTAMOS_ACTIVOS",RUTA_ADMIN."/prestamosactivos");
define("RUTA_EQUIPOS_AVERIADOS",RUTA_ADMIN."/equiposaveriados");
//recursos
define("RUTA_CSS_PROPIAS", SERVIDOR . "/css/propias/");
define("RUTA_CSS_LIBRERIAS", SERVIDOR . "/css/librerias/");
define("RUTA_JS_LIBRERIAS", SERVIDOR . "/js/librerias/");
define("RUTA_JS_FUNCIONES", SERVIDOR . "/js/funciones/");
?>

