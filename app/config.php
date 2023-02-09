<?php 

// INFORMACIÓN DE LA BASE DE DATOS EN POSTGRESQL
define('NOMBRE_SERVIDOR', 'ec2-18-235-45-217.compute-1.amazonaws.com');
define('NOMBRE_USUARIO', 'dtvsvcynmsqwjc');
define('PASSWORD', 'f712650f4fbdc6586dc3b5458381142440405d9d207cf3feb4e989f33377c2aa');
define('BASE_DE_DATOS', 'd5deb42s7lc059');

//NUMERO IDENTIFICADOR DEL ADMINISTRADOR
$admin=1;

//rutas de la web
define("SERVIDOR","https://prestamo-equipos.herokuapp.com");
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

