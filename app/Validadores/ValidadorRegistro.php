<?php

class ValidadorRegistro
{

	private $aviso_inicio;
	private $aviso_cierre;

	private $cod_per;
	private $pri_nombre;
	private $seg_nombre;
	private $ter_nombre;
	private $pri_apellido;
	private $seg_apellido;
	private $fecha_nac;
	private $email;
	private $clave;
	private $telefono;
	private $cod_rol;
	private $cod_fac;

	private $errorCod_per;
	private $errorPri_nombre;
	private $errorSeg_nombre;
	private $errorTer_nombre;
	private $errorPri_apellido;
	private $errorSeg_apellido;
	private $errorFecha_nac;
	private $errorEmail;
	private $errorPassword1;
	private $errorPassword2;
	private $errorTelefono;
	private $errorCod_rol;
	private $errorCod_fac;


	public function __construct($cod_per, $pri_nombre, $seg_nombre, $ter_nombre, $pri_apellido, $seg_apellido, $fecha_nac, $email, $password1, $password2, $telefono, $cod_rol, $cod_fac, $conexion)
	{
		$this->aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
		$this->aviso_cierre = "</div>";

		$this->cod_per = "";
		$this->pri_nombre = "";
		$this->seg_nombre = "";
		$this->ter_nombre = "";
		$this->pri_apellido = "";
		$this->seg_apellido = "";
		$this->fecha_nac = "";
		$this->email = "";
		$this->clave = "";
		$this->telefono = "";
		$this->cod_rol = "";
		$this->cod_fac= "";
		$this->errorCod_per = $this->validarCod_per($cod_per,$conexion);
		//$this->errorCaracEsp = $this->quitar_tildes($pri_nombre);
		$this->errorPri_nombre = $this->validarPri_nombre($pri_nombre);
		$this->errorSeg_nombre = $this->validarSeg_Nombre($seg_nombre);
		$this->errorTer_nombre = $this->validarTer_Nombre($ter_nombre);
		$this->errorPri_apellido = $this->validarPri_apellido($pri_apellido);
		$this->errorSeg_apellido = $this->validarSeg_apellido($conexion, $pri_nombre, $seg_nombre, $ter_nombre, $pri_apellido, $seg_apellido);
		$this->errorFecha_nac = $this->validarFecha_nac($fecha_nac);
		$this->errorEmail = $this->validarEmail($email, $conexion);
		$this->errorPassword1 = $this->validarPassword1($password1);
		$this->errorPassword2 = $this->validarPassword2($password1, $password2);
		$this->errorTelefono = $this->validarTelefono($telefono,$conexion);
		$this->errorCod_rol = $this->validarCod_rol($cod_rol);
		$this->errorCod_fac = $this->validarCod_fac($cod_fac);

		if($this->errorPassword1==="" & $this->errorPassword2===""){
			$this-> clave=$password1;
		}
	}

	private function variableIniciada($variable)
	{

		if (isset($variable) && !empty($variable)) {
			return true;
		} else {
			return false;
		}
	}

	//CARACTERES ESPECIALES
	private function caracteresEspeciales($cadena) {
		$cadena = trim($cadena);
		$cadena = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$cadena
		);
	
		$cadena = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$cadena );
	
		$cadena = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$cadena );
	
		$cadena = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$cadena );
	
		$cadena = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$cadena );
	
		$cadena = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C'),
			$cadena
		);

		$cadena = strtoupper($cadena);
	
		return $cadena;
		}

	//VALIDADOR DE CEDULA
	private function validarCod_per($cod_per,$conexion)
	{
		if (!$this->variableIniciada($cod_per)) {
			return "Ingrese su identificación";
		} else {
			if(strlen($cod_per) >= 15){
				return "Identificación muy extensa";
			}
			$this->cod_per = $cod_per;
		}
		if(RepositorioPersona::cod_perExiste($conexion,$cod_per)){
			return "El número de identificacion ya se encuentra registrado";
		}
		if (!ctype_digit($cod_per)) {
			return "Numero de indentificacion inválido";
		}

		return "";
	}
	


	public function mostrar_cod_per()
	{
		if ($this->cod_per !== "") {
			echo 'value="' . $this->cod_per . '"';
		}
	}
	public function mostrar_error_cod_per()
	{
		if ($this->errorCod_per !== "") {
			echo $this->aviso_inicio . $this->errorCod_per . $this->aviso_cierre;
		}
	}

	//VALIDADOR DE PRIMER NOMBRE
	private function validarPri_nombre($pri_nombre)
	{
		$pri_nombre = $this->caracteresEspeciales($pri_nombre);

		if (!$this->variableIniciada($pri_nombre)) {
			return "Ingrese su primer nombre";
		} else {
			if(strlen($pri_nombre) > 15){
				return "Ha superado 15 carácteres";
			}
			$this->pri_nombre = $pri_nombre;
		}
		if (!ctype_alpha($pri_nombre)) {
			return "Este campo solo admite valores alfabéticos";
		}
		return "";
	}
	public function mostrar_pri_nombre()
	{
		if ($this->pri_nombre !== "") {
			echo 'value="' . $this->pri_nombre . '"';
		}
	}
	public function mostrar_error_pri_nombre()
	{
		if ($this->errorPri_nombre !== "") {
			echo $this->aviso_inicio . $this->errorPri_nombre . $this->aviso_cierre;
		}
	}

	//VALIDADOR DE SEGUNDO NOMBRE
	private function validarSeg_nombre($seg_nombre)
	{
		$seg_nombre = $this->caracteresEspeciales($seg_nombre);
		
		if ($this->variableIniciada($seg_nombre) && !ctype_alpha($seg_nombre)) {
			$this->seg_nombre = $seg_nombre;
			return "Este campo solo admite valores alfabéticos";
		} else {
			if(strlen($seg_nombre) > 15){
				return "Ha superado 15 carácteres";
			}
			$this->seg_nombre = $seg_nombre;
		}
		return "";
	}
	public function mostrar_seg_nombre()
	{
		if ($this->seg_nombre !== "") {
			echo 'value="' . $this->seg_nombre . '"';
		}
	}
	public function mostrar_error_seg_nombre()
	{
		if ($this->errorSeg_nombre !== "") {
			echo $this->aviso_inicio . $this->errorSeg_nombre . $this->aviso_cierre;
		}
	}

	//VALIDADOR DE TERCER NOMBRE
	private function validarTer_nombre($ter_nombre)
	{
		$ter_nombre = $this->caracteresEspeciales($ter_nombre);
		if ($this->variableIniciada($ter_nombre) && !ctype_alpha($ter_nombre)) {
			$this->ter_nombre = $ter_nombre;
			return "Este campo solo admite valores alfabéticos";
		} else {
			if(strlen($ter_nombre) > 15){
				return "Ha superado 15 carácteres";
			}
			$this->ter_nombre = $ter_nombre;
		}
		return "";
	}
	public function mostrar_ter_nombre()
	{
		if ($this->ter_nombre !== "") {
			echo 'value="' . $this->ter_nombre . '"';
		}
	}
	public function mostrar_error_ter_nombre()
	{
		if ($this->errorTer_nombre !== "") {
			echo $this->aviso_inicio . $this->errorTer_nombre . $this->aviso_cierre;
		}
	}
	//VALIDADOR DE PRIMER APELLIDO
	private function validarPri_apellido($pri_apellido)
	{
		$pri_apellido = $this->caracteresEspeciales($pri_apellido);
		if (!$this->variableIniciada($pri_apellido)) {
			return "Ingrese su primer apellido";
		} else {
			$this->pri_apellido = $pri_apellido;
			if(strlen($pri_apellido) > 15){
				return "Ha superado 15 carácteres";
			}
		}
		if (!ctype_alpha($pri_apellido)) {
			return "Este campo solo admite valores alfabéticos";
		}
		return "";
	}
	public function mostrar_pri_apellido()
	{
		if ($this->pri_apellido !== "") {
			echo 'value="' . $this->pri_apellido . '"';
		}
	}
	public function mostrar_error_pri_apellido()
	{
		if ($this->errorPri_apellido !== "") {
			echo $this->aviso_inicio . $this->errorPri_apellido . $this->aviso_cierre;
		}
	}
	//VALIDADOR DE SEGUNDO APELLIDO Y NOMBRE COMPLETO
	private function validarSeg_apellido($conexion, $pri_nombre, $seg_nombre, $ter_nombre, $pri_apellido, $seg_apellido)
	{
		$seg_apellido = $this->caracteresEspeciales($seg_apellido);
		if (!$this->variableIniciada($seg_apellido)) {
			return "Ingrese su segundo apellido";
		} else {
			if(strlen($seg_apellido) > 15){
				return "Ha superado 15 carácteres";
			}
			$this->seg_apellido = $seg_apellido;
		}
		if (!ctype_alpha($seg_apellido)) {
			return "Este campo solo admite valores alfabéticos";
		}
		if (RepositorioPersona::nombreExiste($conexion, $pri_nombre, $seg_nombre, $ter_nombre, $pri_apellido, $seg_apellido)) {
			return "Los nombres y apellidos de la persona ya se encuentran en uso";
		}
		return "";
	}
	public function mostrar_seg_apellido()
	{
		if ($this->seg_apellido !== "") {
			echo 'value="' . $this->seg_apellido . '"';
		}
	}
	public function mostrar_error_seg_apellido()
	{
		if ($this->errorSeg_apellido !== "") {
			echo $this->aviso_inicio . $this->errorSeg_apellido . $this->aviso_cierre;
		}
	}
	//VALIDADOR DE FECHA DE NACIMIENTO
	private function validarFecha_nac($fecha_nac)
	{
		$fechaActual = date('Y-m-d');
	
		if (!$this->variableIniciada($fecha_nac)){
			return "Ingrese su fecha de nacimiento";
		} else {
			$this->fecha_nac = $fecha_nac;
		}
		if ($fecha_nac>$fechaActual) {
			return "La fecha de nacimiento no es válida";
		}

		if($this->calcularEdad($fecha_nac) < 15){
			return "No puede registrase por ser menor de 15 años";
		}
		
		return "";
	}
	public function mostrar_fecha()
	{
		if ($this->fecha_nac !== "") {
			echo 'value="' . $this->fecha_nac . '"';
		}
	}
	public function mostrar_error_fecha()
	{
		if ($this->errorFecha_nac !== "") {
			echo $this->aviso_inicio . $this->errorFecha_nac . $this->aviso_cierre;
		}
	}

	public function calcularEdad($fechanacimiento){
		list($ano,$mes,$dia) = explode("-",$fechanacimiento);
		$ano_diferencia  = date("Y") - $ano;
		$mes_diferencia = date("m") - $mes;
		$dia_diferencia   = date("d") - $dia;
		if ($dia_diferencia < 0 || $mes_diferencia < 0)
		  $ano_diferencia--;
		return $ano_diferencia;
	  }
	
	//VALIDADOR DE EMAIL
	private function validarEmail($email, $conexion)
	{

		if (!$this->variableIniciada($email)) {
			return "Ingrese su correo";
		} else {
			$this->email = $email;
		}
		if (RepositorioPersona::emailExiste($conexion, $email)) {
			return "El correo ya se encuentra en uso";
		}


		if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
			return "Este correo ($email) no es válido, ejemplo: email@gmail.com";
		}
		return "";
	}
	public function mostrar_email()
	{
		if ($this->email !== "") {
			echo 'value="' . $this->email . '"';
		}
	}
	public function mostrar_error_email()
	{
		if ($this->errorEmail !== "") {
			echo $this->aviso_inicio . $this->errorEmail . $this->aviso_cierre;
		}
	}
	
	//VALIDADOR DE CONSTRASEÑA
	private function validarPassword1($clave)
	{

		if (!$this->variableIniciada($clave)) {
			return "Ingrese su contraseña antes de continuar";
		}

		if (strlen($clave) < 6) {
			return "Por tu seguridad la contraseña debe contener al menos 6 caracteres";
		}

		if ($this->cod_per === $clave) {
			return "Por tu seguridad la contraseña debe ser diferente de tu numero de indentificación";
		}

		return "";
	}

	public function mostrar_error_password1()
	{
		if ($this->errorPassword1 !== "") {
			echo $this->aviso_inicio . $this->errorPassword1 . $this->aviso_cierre;
		}
	}

	private function validarPassword2($password1, $password2)
	{

		if (!$this->variableIniciada($password1)) {
			return "Ingrese primero su contraseña";
		}

		if (!$this->variableIniciada($password2)) {
			return "Repita su contraseña";
		}

		if ($password1 !== $password2) {
			return "Las contraseñas no son iguales";
		}

		return "";
	}

	public function mostrar_error_password2()
	{
		if ($this->errorPassword2 !== "") {
			echo $this->aviso_inicio . $this->errorPassword2 . $this->aviso_cierre;
		}
	}
	//VALIDADOR DE TELEFONO
	private function validarTelefono($telefono,$conexion)
	{

		if (!$this->variableIniciada($telefono)) {
			return "Ingrese su número de teléfono";
		} else {
			$this->telefono = $telefono;
		}
		if (strlen($telefono) !== 10) {
			return "El número de teléfono debe contener 10 digitos";
		}
		if(RepositorioPersona::telefonoExiste($conexion,$telefono)){
			return "El número de teléfono ya está en uso";
		}
		if (!ctype_digit($telefono)) {
			return "Número de teléfono inválido";
		}
		return "";
	}
	public function mostrar_telefono()
	{
		if ($this->telefono !== "") {
			echo 'value="' . $this->telefono . '"';
		}
	}
	public function mostrar_error_telefono()
	{
		if ($this->errorTelefono !== "") {
			echo $this->aviso_inicio . $this->errorTelefono . $this->aviso_cierre;
		}
	}
	//VALIDADOR DE CODIGO DE ROL
	private function validarCod_rol($cod_rol)
	{
		if (!$this->variableIniciada($cod_rol)) {
			return "Debe elegir un rol";
		} else {
			$this->cod_rol = $cod_rol;
		}
		return "";
	}
	public function mostrar_error_cod_rol()
	{
		if ($this->errorCod_rol !== "") {
			echo $this->aviso_inicio . $this->errorCod_rol . $this->aviso_cierre;
		}
	}
	//VALIDADOR DE CODIGO DE FACULTAD
	private function validarCod_fac($cod_fac)
	{
		if (!$this->variableIniciada($cod_fac)) {
			return "Debe elegir una facultad";
		} else {
			$this->cod_fac = $cod_fac;
		}
		return "";
	}
	public function mostrar_error_cod_fac()
	{
		if ($this->errorCod_fac !== "") {
			echo $this->aviso_inicio . $this->errorCod_fac . $this->aviso_cierre;
		}
	}
	// REGISTRO VALIDO
	public function registroValido()
	{
		if ($this->errorCod_per === "" && $this->errorPri_nombre === "" && $this->errorSeg_nombre === "" 
			&& $this->errorTer_nombre === "" && $this->errorPri_apellido === "" && $this->errorSeg_apellido === "" 
			&& $this->errorFecha_nac ==="" && $this->errorEmail === "" && $this->errorPassword1 === "" 
			&& $this->errorPassword2 === "" && $this->errorTelefono === "" && $this->errorCod_rol ==="" 
			&& $this->errorCod_fac==="") {
			return true;
		} else {
			return false;
		}
	}


	//GETTERS VARIABLES

	public function obtenerCod_per()
	{
		return $this->cod_per;
	}

	public function obtenerPri_nombre()
	{	
		return $this->pri_nombre;
	}

	public function obtenerSeg_nombre()
	{
		return $this->seg_nombre;
	}

	public function obtenerTer_nombre()
	{
		return $this->ter_nombre;
	}

	public function obtenerPri_apellido()
	{
		return $this->pri_apellido;
	}

	public function obtenerSeg_apellido()
	{
		return strtoupper($this->seg_apellido);
	}

	public function obtenerFecha_nac()
	{
		return $this->fecha_nac;
	}

	public function obtenerEmail()
	{
		return $this->email;
	}
	public function obtenerClave()
	{
		return $this->clave;
	}
	public function obtenerTelefono()
	{
		return $this->telefono;
	}

	public function obtenerCod_rol()
	{	
		return $this->cod_rol;
	}
	public function obtenerCod_fac()
	{
		return $this->cod_fac;
	}

}
