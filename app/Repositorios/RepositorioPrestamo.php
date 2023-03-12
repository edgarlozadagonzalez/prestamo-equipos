<?php
class RepositorioPrestamo{

    public static function insertarPrestamo($conexion, $prestamo,$estado){

		$prestamoInsertado = false;
		if (isset($conexion)){
			try{
				$sql = "INSERT INTO prestamos (fecha_inicio,cod_per,cod_equ) VALUES (:fecha_inicio, :cod_per, :cod_equ)";
				$sql2= "UPDATE equipos SET estado = :estado WHERE cod_equ=:cod_equ";
				$conexion->beginTransaction();
				$sentencia = $conexion->prepare($sql);
				$sentencia2 = $conexion->prepare($sql2);
				$fecha_inicio = $prestamo->obtenerFecha_inicio();
                $cod_per = $prestamo->obtenerCod_per();
                $cod_equ = $prestamo->obtenerCod_equ();
				$sentencia->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_per', $cod_per, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
				$sentencia2->bindParam(':estado', $estado, PDO::PARAM_STR);
				$sentencia2->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
				$sentencia->execute();
				$sentencia2->execute();
				$resultado=$conexion->commit();
				if(!empty($resultado)){
					$prestamoInsertado  = true ;
					echo $prestamoInsertado ;
			   }	
			   else{
				$prestamoInsertado = false;
				   echo $prestamoInsertado ;
			   }
			}
			catch(PDOException $e){
				$conexion->rollback();
				print "ERROR". $e->getMessage();
			}
		}
		return $prestamoInsertado; //true o false
	}

	public static function insertarPrestamoAdmin($conexion, $prestamo,$estado){

		$prestamoInsertado = false;
		if (isset($conexion)){
			try{
				$sql = "INSERT INTO prestamos (fecha_inicio,fecha_fin,cod_per,cod_equ) VALUES (:fecha_inicio, :fecha_fin, :cod_per, :cod_equ)";
				$sql2= "UPDATE equipos SET estado = :estado WHERE cod_equ=:cod_equ";
				$conexion->beginTransaction();
				$sentencia = $conexion->prepare($sql);
				$sentencia2 = $conexion->prepare($sql2);

				$d=explode("T",$prestamo->obtenerFecha_inicio());
				$fecha_inicio = $d[0].' '.$d[1].':00';
				$fecha_fin = null;
				if(!empty($prestamo->obtenerFecha_fin())){
					$d=explode("T",$prestamo->obtenerFecha_fin());
					$fecha_fin = $d[0].' '.$d[1].':00';
				}
                $cod_per = $prestamo->obtenerCod_per();
                $cod_equ = $prestamo->obtenerCod_equ();
				$sentencia->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
				$sentencia->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_per', $cod_per, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
				$sentencia2->bindParam(':estado', $estado, PDO::PARAM_STR);
				$sentencia2->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
				$sentencia->execute();
				$sentencia2->execute();
				$resultado=$conexion->commit();
				if(!empty($resultado)){
					$prestamoInsertado  = true ;
			   }	
			   else{
				$prestamoInsertado = false;
				echo $prestamoInsertado;
			   }
			}
			catch(PDOException $e){
				$conexion->rollback();
				print "ERROR". $e->getMessage();
			}
		}
		return $prestamoInsertado; //true o false
	}
	public static function finalizarPrestamo($conexion,$cod_pres,$cod_equ,$cod_per,$fecha_fin,$estado)
    {
        $prestamoFinalizado = false;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE prestamos SET fecha_fin = :fecha_fin WHERE cod_pres = :cod_pres";
				$sql2 = "UPDATE equipos SET estado = :estado WHERE cod_equ=(SELECT cod_equ FROM prestamos WHERE cod_pres =:cod_pres)";
				
				$sql3 = "SELECT pres.fecha_inicio,per.email,per.telefono,equ.marca,equ.descripcion,disp.nombre_disp,sal.nombre_sal,sal.num_piso FROM prestamos as pres INNER JOIN personas as per ON per.cod_per=pres.cod_per
				INNER JOIN equipos as equ ON equ.cod_equ=pres.cod_equ 
				INNER JOIN dispositivos as disp ON equ.cod_disp = disp.cod_disp
				INNER JOIN salas as sal ON equ.cod_sal= sal.cod_sal WHERE equ.cod_equ= :cod_equ AND per.cod_per=:cod_per;";
				
				$sql4 = "INSERT INTO historial VALUES (:cod_pres,:fecha_inicio,:fecha_fin,:cod_per,:email,:telefono,:cod_equ,:marca,:descripcion,:nombre_disp,:nombre_sal,:num_piso)";
				
				$conexion->beginTransaction();
                $sentencia = $conexion->prepare($sql);
				$sentencia2 = $conexion->prepare($sql2);
				$sentencia3 = $conexion->prepare($sql3);
				$sentencia4 = $conexion->prepare($sql4);

				$sentencia3->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
				$sentencia3->bindParam(':cod_per', $cod_per, PDO::PARAM_STR);
				$sentencia3->execute();
				$historial = $sentencia3->fetch();
                $sentencia->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_pres', $cod_pres, PDO::PARAM_STR);
				$sentencia2->bindParam(':estado', $estado, PDO::PARAM_STR);
				$sentencia2->bindParam(':cod_pres', $cod_pres, PDO::PARAM_STR);

				$sentencia4->bindParam(':cod_pres', $cod_pres, PDO::PARAM_STR);
				$sentencia4->bindParam(':fecha_inicio', $historial['fecha_inicio'], PDO::PARAM_STR);
				$sentencia4->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
				$sentencia4->bindParam(':cod_per', $cod_per, PDO::PARAM_STR);
				$sentencia4->bindParam(':email', $historial['email'], PDO::PARAM_STR);
				$sentencia4->bindParam(':telefono', $historial['telefono'], PDO::PARAM_STR);
				$sentencia4->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
				$sentencia4->bindParam(':marca', $historial['marca'], PDO::PARAM_STR);
				$sentencia4->bindParam(':descripcion', $historial['descripcion'], PDO::PARAM_STR);
				$sentencia4->bindParam(':nombre_disp', $historial['nombre_disp'], PDO::PARAM_STR);
				$sentencia4->bindParam(':nombre_sal', $historial['nombre_sal'], PDO::PARAM_STR);
				$sentencia4->bindParam(':num_piso', $historial['num_piso'], PDO::PARAM_STR);
                $sentencia->execute();
				$sentencia2->execute();
				$sentencia4->execute();
				$resultado=$conexion->commit();
				if(!empty($resultado)){
					$prestamoFinalizado = true ;
					echo $prestamoFinalizado ;
			   }
			   else{
				$prestamoFinalizado = false;
				   echo $prestamoFinalizado ;
			   }
            } catch (PDOException $e) {
				$conexion->rollback();
                print "ERROR" . $e->getMessage();
            }
        }
        return $prestamoFinalizado; //true o false
    }
	public static function actualizarHistorial($conexion,$cod_pres,$cod_equ,$cod_per,$fecha_fin,$estado)
    {
        $prestamoFinalizado = false;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE prestamos SET fecha_fin = :fecha_fin WHERE cod_pres = :cod_pres";
				$sql2 = "UPDATE equipos SET estado = :estado WHERE cod_equ=(SELECT cod_equ FROM prestamos WHERE cod_pres =:cod_pres)";
				
				$sql3 = "SELECT pres.fecha_inicio,per.email,per.telefono,equ.marca,equ.descripcion,disp.nombre_disp,sal.nombre_sal,sal.num_piso FROM prestamos as pres INNER JOIN personas as per ON per.cod_per=pres.cod_per
				INNER JOIN equipos as equ ON equ.cod_equ=pres.cod_equ 
				INNER JOIN dispositivos as disp ON equ.cod_disp = disp.cod_disp
				INNER JOIN salas as sal ON equ.cod_sal= sal.cod_sal WHERE equ.cod_equ= :cod_equ AND per.cod_per=:cod_per;";
				
				$sql4 = "UPDATE historial SET cod_pres = :cod_pres,fecha_inicio =:fecha_inicio, fecha_fin =:fecha_fin,
				cod_per=:cod_per,email=:email,telefono=:telefono,cod_equ=:cod_equ,marca=:marca,descripcion=:descripcion,
				nombre_disp=:nombre_disp,nombre_sal=:nombre_sal,num_piso=:num_piso WHERE cod_pres = :cod_pres";
				
				$conexion->beginTransaction();
                $sentencia = $conexion->prepare($sql);
				$sentencia2 = $conexion->prepare($sql2);
				$sentencia3 = $conexion->prepare($sql3);
				$sentencia4 = $conexion->prepare($sql4);

				$sentencia3->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
				$sentencia3->bindParam(':cod_per', $cod_per, PDO::PARAM_STR);
				$sentencia3->execute();
				$historial = $sentencia3->fetch();
                $sentencia->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_pres', $cod_pres, PDO::PARAM_STR);
				$sentencia2->bindParam(':estado', $estado, PDO::PARAM_STR);
				$sentencia2->bindParam(':cod_pres', $cod_pres, PDO::PARAM_STR);

				$sentencia4->bindParam(':cod_pres', $cod_pres, PDO::PARAM_STR);
				$sentencia4->bindParam(':fecha_inicio', $historial['fecha_inicio'], PDO::PARAM_STR);
				$sentencia4->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
				$sentencia4->bindParam(':cod_per', $cod_per, PDO::PARAM_STR);
				$sentencia4->bindParam(':email', $historial['email'], PDO::PARAM_STR);
				$sentencia4->bindParam(':telefono', $historial['telefono'], PDO::PARAM_STR);
				$sentencia4->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
				$sentencia4->bindParam(':marca', $historial['marca'], PDO::PARAM_STR);
				$sentencia4->bindParam(':descripcion', $historial['descripcion'], PDO::PARAM_STR);
				$sentencia4->bindParam(':nombre_disp', $historial['nombre_disp'], PDO::PARAM_STR);
				$sentencia4->bindParam(':nombre_sal', $historial['nombre_sal'], PDO::PARAM_STR);
				$sentencia4->bindParam(':num_piso', $historial['num_piso'], PDO::PARAM_STR);
                $sentencia->execute();
				$sentencia2->execute();
				$sentencia4->execute();
				$resultado=$conexion->commit();
				if(!empty($resultado)){
					$prestamoFinalizado = true ;
					echo $prestamoFinalizado ;
			   }
			   else{
				$prestamoFinalizado = false;
				   echo $prestamoFinalizado ;
			   }
            } catch (PDOException $e) {
				$conexion->rollback();
                print "ERROR" . $e->getMessage();
            }
        }
        return $prestamoFinalizado; //true o false
    }
	
	public static function obtenerPrestamosPersona($conexion,$cod_per)
    {
        $prestamos = array();
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM historial WHERE cod_per =:cod_per";
                $sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':cod_per', $cod_per, PDO::PARAM_STR);
                $sentencia->execute();
                $prestamos = $sentencia->fetchAll();

            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $prestamos;
    }
	public static function obtenerCodprestamo($conexion,$prestamo)
    {
        $prestamos = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM prestamos WHERE fecha_inicio = :fecha_inicio AND fecha_fin = :fecha_fin AND cod_per =:cod_per AND cod_equ=:cod_equ";
                $sentencia = $conexion->prepare($sql);
                $fecha_inicio = $prestamo->obtenerFecha_inicio();
                $fecha_fin = $prestamo->obtenerFecha_fin();
                $cod_per = $prestamo->obtenerCod_per();
                $cod_equ = $prestamo->obtenerCod_equ();
                $sentencia->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
                $sentencia->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_per', $cod_per, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado= $sentencia->fetchAll();
				if(count($resultado)){
					foreach ($resultado as $fila) {
						$prestamos = new Prestamo(
							$fila['cod_pres'], $fila['fecha_inicio'], $fila['fecha_fin'], $fila['cod_per'], $fila['cod_equ']
						);
					}	
				}
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $prestamos;
    }
	public static function obtenerHistorial($conexion)
    {
        $historial = array();
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM historial";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $historial = $sentencia->fetchAll();

            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $historial;
    }
	public static function obtenerPrestamos($conexion){
		$prestamos =array();
		if(isset($conexion)){
			try {
				$sql = "SELECT * FROM prestamos";
				$sentencia = $conexion -> prepare($sql);
				$sentencia ->execute();
				$resultado = $sentencia->fetchAll();

				if(count($resultado)){
					foreach ($resultado as $fila) {
						$prestamos[] = new Prestamo(
							$fila['cod_pres'], $fila['fecha_inicio'], $fila['fecha_fin'], $fila['cod_per'], $fila['cod_equ']
						);
					}	
				}
			}catch (PDOException $ex) {
				print "ERROR" .$ex->getMessage();
			}
		}
		return $prestamos;
	}

	public static function eliminarPrestamo($conexion, $cod_pres)
    {
        $prestamoEliminado = null;
        if (isset($conexion)) {
            try {
                $sql2= "SELECT * FROM sindevolver WHERE cod_pres=:cod_pres";
                $sentencia2 = $conexion->prepare($sql2);
                $sentencia2->bindParam(':cod_pres', $cod_pres, PDO::PARAM_STR);
                $sentencia2->execute();
                $resultado = $sentencia2->fetch();
                if (!empty($resultado)) {
                    $prestamoEliminado = 'El prestamo no puede ser eliminado, se encuentra en prestamo activo';
                    echo $prestamoEliminado;
                }else{
                    $sql = "DELETE FROM prestamos WHERE cod_pres = :cod_pres";
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindParam(':cod_pres', $cod_pres, PDO::PARAM_STR);
                    $resultado = $sentencia->execute();
                    if (!empty($resultado)) {
                        $prestamoEliminado = true;
                        echo $prestamoEliminado;
                    } else {
                        $prestamoEliminado = false;
                        echo $prestamoEliminado;
                    }
                }
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $prestamoEliminado;
    }
	public static function actualizarPrestamo($conexion, $prestamo)
    {
        $prestamoActualizado = false;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE prestamos SET fecha_inicio = :fecha_inicioU, fecha_fin = :fecha_finU, 
                        cod_per = :cod_perU, cod_equ =:cod_equU WHERE cod_pres = :cod_pres";
                $sentencia = $conexion->prepare($sql);
                $cod_pres = $prestamo->obtenerCod_pres();
                $fecha_inicioU = $prestamo->obtenerFecha_inicio();
                $fecha_finU = $prestamo->obtenerFecha_fin();
                $cod_perU = $prestamo->obtenerCod_per();
                $cod_equU = $prestamo->obtenerCod_equ();
				$sentencia->bindParam(':cod_pres', $cod_pres, PDO::PARAM_STR);
                $sentencia->bindParam(':fecha_inicioU', $fecha_inicioU, PDO::PARAM_STR);
                $sentencia->bindParam(':fecha_finU', $fecha_finU, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_perU', $cod_perU, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_equU', $cod_equU, PDO::PARAM_STR);
                $resultado = $sentencia->execute();
                if (!empty($resultado)) {
                    $prestamoActualizado = true;
                } else {
                    $prestamoActualizado = false;
                    echo $prestamoActualizado;
                }
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $prestamoActualizado; //true o false
    }
	public static function cod_presExiste($conexion, $cod_pres){

		$cod_presExiste = true;

		if(isset($conexion)){
			try{
				$sql = "SELECT cod_pres FROM prestamos WHERE cod_pres = :cod_pres";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':cod_pres', $cod_pres, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
				if(count($resultado)){
					$cod_presExiste = true;
					echo 'El codigo de prestamo ya existe';
				}
				else{
					$cod_presExiste = false;
				}
			}catch(PDOException $e){
				print "ERROR ". $e->getMessage();
			}
		}
		return $cod_presExiste;
	}
	public static function PrestamosActivos($conexion)
    {
      $resultado = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM sindevolver";

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $resultado;
    }
}