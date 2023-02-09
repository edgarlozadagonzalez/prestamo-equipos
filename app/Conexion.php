<?php

class Conexion{

	private static $conexion;

	public static function abrirConexion(){
		if (!isset(self::$conexion)) {
			try{
				include_once 'config.php';

				self::$conexion = new PDO('pgsql:host='.NOMBRE_SERVIDOR.'; dbname='.BASE_DE_DATOS, NOMBRE_USUARIO, PASSWORD);
				self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$conexion->exec("SET NAMES 'UTF8'");
			}
			catch(PDOException $ex){
				print "ERROR ". $ex->getMessage(). "<br>";
				die();
			}
		}
	}

	public static function cerrarConexion(){
		if (isset(self::$conexion)) {
			self::$conexion = null;
		}
	}

	public static function obtenerConexion(){
			return self::$conexion;
	}

}
