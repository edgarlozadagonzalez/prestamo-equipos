<?php 

class RepositorioPersona{

	public static function telefonoExiste($conexion, $telefono){

		$telefonoExiste = true;

		if(isset($conexion)){
			try{
				$sql = "SELECT telefono FROM personas WHERE telefono = :telefono";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':telefono', $telefono, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
				if(count($resultado)){
					$telefonoExiste = true;
				}
				else{
					$telefonoExiste = false;
				}
			}catch(PDOException $e){
				print "ERROR ". $e->getMessage();
			}
		}
		return $telefonoExiste;
	}
	public static function cod_perExiste($conexion, $cod_per){

		$cod_perExiste = true;

		if(isset($conexion)){
			try{
				$sql = "SELECT cod_per FROM personas WHERE cod_per = :cod_per";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':cod_per', $cod_per, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
				if(count($resultado)){
					$cod_perExiste = true;
				}
				else{
					$cod_perExiste = false;
				}
			}catch(PDOException $e){
				print "ERROR ". $e->getMessage();
			}
		}
		return $cod_perExiste;
	}

	public static function obtener_numero_personas($conexion) {
        $total_personas = null;
        
        if (isset($conexion)) {
            try {
                $sql = "SELECT COUNT(*) as total FROM personas";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                $total_personas = $resultado['total'];
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $total_personas;
    }
	public static function obtenerPersonas($conexion){
		$personas =null;
		if(isset($conexion)){
			try {
				$sql = "SELECT * FROM personasview";
				$sentencia = $conexion -> prepare($sql);
				$sentencia ->execute();
				$personas = $sentencia->fetchAll();
			}catch (PDOException $ex) {
				print "ERROR" .$ex->getMessage();
			}
		}
		return $personas;
	}
	public static function insertarPersona($conexion, $persona){

		$personaInsertada = false;

		if (isset($conexion)){

			try{

				$sql = "INSERT INTO personas (cod_per, pri_nombre, seg_nombre, ter_nombre, pri_apellido, seg_apellido, fecha_nac, email, clave, telefono, cod_rol, cod_fac) 
				VALUES (:cod_per, :pri_nombre, :seg_nombre, :ter_nombre, :pri_apellido, :seg_apellido, :fecha_nac, :email, :clave, :telefono, :cod_rol, :cod_fac)";

				$sentencia = $conexion->prepare($sql);

				$cod_per = $persona->obtenerCod_per();
				$pri_nombre = $persona->obtenerPri_nombre();
				$seg_nombre = $persona->obtenerSeg_nombre();
				$ter_nombre = $persona->obtenerTer_nombre();
				$pri_apellido = $persona->obtenerPri_apellido();
				$seg_apellido = $persona->obtenerSeg_apellido();
				$fecha_nac = $persona->obtenerFecha_nac();
				$email = $persona->obtenerEmail();
				$clave = $persona->obtenerClave();
				$telefono = $persona->obtenerTelefono();
				$cod_rol = $persona->obtenerCod_rol();
				$cod_fac = $persona->obtenerCod_fac();
				$sentencia->bindParam(':cod_per', $cod_per, PDO::PARAM_STR);
				$sentencia->bindParam(':pri_nombre', $pri_nombre, PDO::PARAM_STR);
				$sentencia->bindParam(':seg_nombre', $seg_nombre, PDO::PARAM_STR);
				$sentencia->bindParam(':ter_nombre', $ter_nombre, PDO::PARAM_STR);
				$sentencia->bindParam(':pri_apellido', $pri_apellido, PDO::PARAM_STR);
				$sentencia->bindParam(':seg_apellido', $seg_apellido, PDO::PARAM_STR);
				$sentencia->bindParam(':fecha_nac', $fecha_nac, PDO::PARAM_STR);
				$sentencia->bindParam(':email', $email, PDO::PARAM_STR);
				$sentencia->bindParam(':clave', $clave, PDO::PARAM_STR);
				$sentencia->bindParam(':telefono', $telefono, PDO::PARAM_STR);
				$sentencia->bindParam(':cod_rol', $cod_rol, PDO::PARAM_STR);
				$sentencia->bindParam(':cod_fac', $cod_fac, PDO::PARAM_STR);
				$personaInsertada = $sentencia->execute();
			}
			catch(PDOException $e){
				print "ERROR". $e->getMessage();
			}
		}
		return $personaInsertada; //true o false
	}

	public static function obtenerPersonaPorEmail($conexion,$email){
		$persona = null;
		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM personas WHERE email = :email";
				$email= strtolower($email);
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':email', $email, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado = $sentencia -> fetch();
				if (!empty($resultado)) {
					$persona = new Persona($resultado['cod_per'], $resultado['pri_nombre'], $resultado['seg_nombre'], 
					$resultado['ter_nombre'], $resultado['pri_apellido'], $resultado['seg_apellido'], $resultado['fecha_nac'], 
					$resultado['email'], $resultado['clave'], $resultado['telefono'],$resultado['cod_rol'],$resultado['cod_fac']);
				}else {
					$persona=null;
				}
			} catch (PDOException $e) {
				print "ERROR". $e -> getMessage();
			}
		}
		return $persona;
	}
	
	
	public static function nombreExiste($conexion,$pri_nombre,$seg_nombre,$ter_nombre,$pri_apellido,$seg_apellido){

		$nombreExiste = true;

		if(isset($conexion)){

			try{

				$sql = "SELECT * FROM personas WHERE pri_nombre = :pri_nombre AND seg_nombre= :seg_nombre
						AND ter_nombre=:ter_nombre AND pri_apellido=:pri_apellido AND seg_apellido=:seg_apellido";

				$sentencia = $conexion->prepare($sql);
				$pri_nombre=strtolower($pri_nombre);
				$seg_nombre= strtolower($seg_nombre);
				$ter_nombre=strtolower($ter_nombre);
				$pri_apellido=strtolower($pri_apellido);
				$seg_apellido=strtolower($seg_apellido);
				$sentencia->bindParam(':pri_nombre', $pri_nombre, PDO::PARAM_STR);
				$sentencia->bindParam(':seg_nombre', $seg_nombre, PDO::PARAM_STR);
				$sentencia->bindParam(':ter_nombre', $ter_nombre, PDO::PARAM_STR);
				$sentencia->bindParam(':pri_apellido', $pri_apellido, PDO::PARAM_STR);
				$sentencia->bindParam(':seg_apellido', $seg_apellido, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
				if(count($resultado)){
					$nombreExiste = true;
				}
				else{
					$nombreExiste = false;
				}

			}catch(PDOException $e){
				print "ERROR ". $e->getMessage();
			}

		}

		return $nombreExiste;
	}

	public static function emailExiste($conexion, $email){

		$emailExiste = true;

		if(isset($conexion)){

			try{

				$sql = "SELECT * FROM personas WHERE email = :email";
				$email=strtolower($email);
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':email', $email, PDO::PARAM_STR);

				$sentencia->execute();

				$resultado = $sentencia->fetchAll();

				if(count($resultado)){
					$emailExiste = true;
				}
				else{
					$emailExiste = false;
				}

			}catch(PDOException $e){
				print "ERROR ". $e->getMessage();
			}

		}

		return $emailExiste;
	}

	public static function eliminarPersona($conexion, $cod_per)
    {
        $personaEliminada = null;
        if (isset($conexion)) {
            try {
                $sql = "DELETE FROM personas WHERE cod_per = :cod_per";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':cod_per', $cod_per, PDO::PARAM_STR);
                $resultado = $sentencia->execute();
                if (!empty($resultado)) {
                    $personaEliminada = true;
                    echo $personaEliminada;
                } else {
                    $personaEliminada = false;
                    echo $personaEliminada;
                }
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $personaEliminada;
    }

}
