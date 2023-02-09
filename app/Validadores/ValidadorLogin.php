<?php 

class ValidadorLogin {

	private $persona;
	private $error;

	public function __construct($email, $clave, $conexion){

		$this->error = "";

		if (!$this->variable_iniciada($email) || !$this->variable_iniciada($clave)) {
			
			$this->persona = null;
			$this->error = "Introduce tu email y contraseña";
		}
		else{
			$this->persona = RepositorioPersona::obtenerPersonaPorEmail($conexion,$email);

			if (is_null($this->persona) || !password_verify($clave, $this->persona->obtenerClave())) {
				$this->error = "Datos Incorrectos";
			}
		}
	}
	private function variable_iniciada($variable){
		if (!isset($variable) || empty($variable)) {
			return false;
		}
		else{
			return true;
		}
	}

	public function obtenerPersona(){
		return $this->persona;
	}

	public function obtenerError(){
		return $this->error;
	}
	public function mostrar_error(){
		
		if($this-> error!==''){
			echo "<div class ='alert alert-danger' role='alert'>";
			echo $this->error;
			echo "</div>";
		}
	}
}

?>