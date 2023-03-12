<?php
include_once 'app/config.php';
include_once 'app/Conexion.php';
include_once 'app/Entidades/Persona.php';
include_once 'app/Entidades/Rol.php';
include_once 'app/Entidades/Facultad.php';
include_once 'app/Repositorios/RepositorioPersona.php';
include_once 'app/Repositorios/RepositorioRol.php';
include_once 'app/Repositorios/RepositorioFacultad.php';
include_once 'app/Validadores/ValidadorRegistro.php';
include_once 'app/Redireccion.php';	

Redireccion::PaginaLogica();

Conexion::abrirConexion();
$conexion = Conexion::obtenerConexion();
$sql = "SELECT * FROM roles";
$sentencia = $conexion -> prepare($sql);
$sentencia ->execute();
$roles = $sentencia->fetchAll();

$sql2 = "SELECT * FROM facultades";
$sentencia = $conexion -> prepare($sql2);
$sentencia ->execute();
$facultades = $sentencia->fetchAll();

Conexion::cerrarConexion();

Conexion::abrirConexion();
if (isset($_POST['registro'])) {
	Conexion::abrirConexion();
	$validador = new ValidadorRegistro($_POST['cod_per'],$_POST['pri_nombre'],$_POST['seg_nombre'],$_POST['ter_nombre'],
		$_POST['pri_apellido'],$_POST['seg_apellido'],$_POST['fecha_nac'],$_POST['email'],htmlspecialchars($_POST['password1']),
		htmlspecialchars($_POST['password2']),$_POST['telefono'],$_POST['cod_rol'],$_POST['cod_fac'],Conexion::obtenerConexion());

	if ($validador->registroValido()) {
		$persona = new Persona($validador->obtenerCod_per(),$validador->obtenerPri_nombre(),$validador->obtenerSeg_nombre(),
			$validador->obtenerTer_nombre(),$validador->obtenerPri_apellido(),$validador->obtenerSeg_apellido(),
			$validador->obtenerFecha_nac(),$validador->obtenerEmail(),password_hash($validador->obtenerClave(),PASSWORD_DEFAULT),$validador->obtenerTelefono(),
			$validador->obtenerCod_rol(),$validador->obtenerCod_fac());
		$personaInsertada=RepositorioPersona::insertarPersona(Conexion::obtenerConexion(),$persona);
		if($personaInsertada){
			Redireccion::redirigir(RUTA_REGISTRO_CORRECTO.'/'.$persona->obtenerPri_nombre());
		}	
	}
	Conexion::cerrarConexion();
}
$titulo = 'Registro';
include_once 'plantillas/documento-declaracion.php';
include_once 'plantillas/navbar.php';
?>
<div class="container">
	<div class="jumbotron">
		<h1 class="text-center">REGISTRO DE USUARIO</h1>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-6 text-center">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						Instrucciones
					</h3>
				</div>
				<div class="panel-body">
					<br>
					<p class="text-justify">
						Por favor rellene el siguiente formulario, con datos reales
						ya que se requiere de estos para gestionar sus préstamos.
						Te recomendamos usar una contraseña que contenga letras minúsculas,
						mayúsculas, números y símbolos.
						La identificación no debe tener ni puntos ni comas ej:0123546789.
					</p>
					<br>
					<a href="<?php echo RUTA_LOGIN?>">¿Ya tienes cuenta?</a>
					<br>
					<br>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title text-center">
						Ingresa tus datos
					</h3>
				</div>
				<div class="panel-body">
					<form role="form" method="POST" action="<?php echo RUTA_REGISTRO ?>">
						<?php
							if(isset($_POST['registro'])){
								include_once 'plantillas/registro_validado.php';
							}else{
								include_once 'plantillas/registro_vacio.php';
							}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include_once 'plantillas/documento-cierre.php';
?>