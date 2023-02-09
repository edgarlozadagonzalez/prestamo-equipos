<?php
class RepositorioEquipo
{

    public static function insertarEquipo($conexion, $equipo)
    {

        $equipoInsertado = false;
        if (isset($conexion)) {
            try {
                $sql = "INSERT INTO equipos (cod_equ, marca, valor, estado, descripcion, cod_sal, cod_disp) 
				VALUES (:cod_equ, :marca, :valor, :estado, :descripcion, :cod_sal, :cod_disp)";
                $sentencia = $conexion->prepare($sql);
                $cod_equ = $equipo->obtenerCod_equ();
                $marca = $equipo->obtenerMarca();
                $valor = $equipo->obtenerValor();
                $estado = $equipo->obtenerEstado();
                $descripcion = $equipo->obtenerDescripcion();
                $cod_sal = $equipo->obtenerCod_sal();
                $cod_disp = $equipo->obtenerCod_disp();
                $sentencia->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
                $sentencia->bindParam(':marca', $marca, PDO::PARAM_STR);
                $sentencia->bindParam(':valor', $valor, PDO::PARAM_STR);
                $sentencia->bindParam(':estado', $estado, PDO::PARAM_STR);
                $sentencia->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_sal', $cod_sal, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_disp', $cod_disp, PDO::PARAM_STR);
                $resultado = $sentencia->execute();
                if(!empty($resultado)){
                    $equipoInsertado = true ;
                    echo $equipoInsertado;
               }
               else{
                   $equipoInsertado = false;
                   echo $equipoInsertado;
               }
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $equipoInsertado; //true o false
    }
    public static function obtenerEquipos($conexion)
    {
        $equipos = array();
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM equipos";
                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $equipos[] = new Equipo(
                            $fila['cod_equ'],
                            $fila['marca'],
                            $fila['valor'],
                            $fila['estado'],
                            $fila['descripcion'],
                            $fila['cod_sal'],
                            $fila['cod_disp']
                        );
                    }
                } else {
                    print 'No hay equipos registrados';
                }
            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $equipos;
    }
    public static function obtenerEquiposDisponibles($conexion)
    {
      $resultado = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM equiposdisponibles";

                $sentencia = $conexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $resultado;
    }
    public static function equiposSindevolver($conexion,$cod_per)
    {
      $resultado = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM sindevolver where cod_per = :cod_per";

                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':cod_per', $cod_per, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

            } catch (PDOException $ex) {
                print "ERROR" . $ex->getMessage();
            }
        }
        return $resultado;
    }
    public static function eliminarEquipo($conexion, $cod_equ)
    {
        $equipoEliminado = null;
        if (isset($conexion)) {
            try {
                $sql2= "SELECT * FROM sindevolver WHERE cod_equ=:cod_equ";
                $sentencia2 = $conexion->prepare($sql2);
                $sentencia2->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
                $sentencia2->execute();
                $resultado = $sentencia2->fetch();
                if (!empty($resultado)) {
                    $equipoEliminado = 'El equipo no puede ser eliminado, se encuentra en prestamo activo';
                    echo $equipoEliminado;
                }else{
                    $sql = "DELETE FROM equipos WHERE cod_equ = :cod_equ";
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
                    $resultado = $sentencia->execute();
                    if (!empty($resultado)) {
                        $equipoEliminado = true;
                        echo $equipoEliminado;
                    } else {
                        $equipoEliminado = false;
                        echo $equipoEliminado;
                    }
                }
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $equipoEliminado;
    }

    public static function actualizarEquipo($conexion, $equipo, $cod_equ)
    {

        $equipoActualizado = false;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE equipos SET cod_equ = :cod_equU, marca = :marcaU, valor = :valorU, 
                        estado = :estadoU, descripcion =:descripcionU, cod_sal =:cod_salU, cod_disp =:cod_dispU
                        WHERE cod_equ = :cod_equ";
                $sentencia = $conexion->prepare($sql);
                $cod_equU = $equipo->obtenerCod_equ();
                $marcaU = $equipo->obtenerMarca();
                $valorU = $equipo->obtenerValor();
                $estadoU = $equipo->obtenerEstado();
                $descripcionU = $equipo->obtenerDescripcion();
                $cod_salU = $equipo->obtenerCod_sal();
                $cod_dispU = $equipo->obtenerCod_disp();
                $sentencia->bindParam(':cod_equU', $cod_equU, PDO::PARAM_STR);
                $sentencia->bindParam(':marcaU', $marcaU, PDO::PARAM_STR);
                $sentencia->bindParam(':valorU', $valorU, PDO::PARAM_STR);
                $sentencia->bindParam(':estadoU', $estadoU, PDO::PARAM_STR);
                $sentencia->bindParam(':descripcionU', $descripcionU, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_salU', $cod_salU, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_dispU', $cod_dispU, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
                $resultado = $sentencia->execute();
                if (!empty($resultado)) {
                    $equipoActualizado = true;
                    echo $equipoActualizado;
                } else {
                    $equipoActualizado = false;
                    echo $equipoActualizado;
                }
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $equipoActualizado; //true o false
    }
    public static function actualizarEstado($conexion,$cod_equ,$estado)
    {

        $estadoActualizado = false;
        if (isset($conexion)) {
            try {
                $sql = "UPDATE equipos SET estado = :estado WHERE cod_equ = :cod_equ";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':estado', $estado, PDO::PARAM_STR);
                $sentencia->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
                $estadoActualizado = $sentencia->execute();
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $estadoActualizado; //true o false
    }

    public static function cod_equExiste($conexion, $cod_equ){

		$cod_equExiste = true;

		if(isset($conexion)){
			try{
				$sql = "SELECT cod_equ FROM equipos WHERE cod_equ = :cod_equ";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado = $sentencia->fetchAll();
				if(count($resultado)){
					$cod_equExiste = true;
				}
				else{
					$cod_equExiste = false;
				}
			}catch(PDOException $e){
				print "ERROR ". $e->getMessage();
			}
		}
		return $cod_equExiste;
	}
    public static function obtenerEstadoequipo($conexion,$cod_equ)
    {
        $estadoEquipo = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT estado FROM equipos WHERE cod_equ = :cod_equ";
                $sentencia = $conexion->prepare($sql);
                $sentencia->bindParam(':cod_equ', $cod_equ, PDO::PARAM_STR);
                $sentencia->execute();
                $estadoEquipo  = $sentencia->fetch();
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $estadoEquipo; 
    }
    public static function Equiposaveriados($conexion)
    {
      $resultado = null;
        if (isset($conexion)) {
            try {
                $sql = "SELECT * FROM equiposaveriados";

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
