<?php

class Persona {

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

	public function __construct ($cod_per, $pri_nombre, $seg_nombre, $ter_nombre, $pri_apellido, $seg_apellido, $fecha_nac,  $email, $clave, $telefono, $cod_rol,$cod_fac){
		$this->cod_per = $cod_per;
		$this->pri_nombre= $pri_nombre;
		$this->seg_nombre = $seg_nombre;
		$this->ter_nombre = $ter_nombre;
		$this->pri_apellido = $pri_apellido;
		$this->seg_apellido= $seg_apellido;
		$this->fecha_nac = $fecha_nac;
		$this->email = $email;
		$this->clave = $clave;
		$this->telefono = $telefono;
		$this->cod_rol = $cod_rol;
		$this->cod_fac = $cod_fac;
	}

	//Getters
	public function obtenerCod_per(){
		return $this->cod_per;
	}

	public function obtenerPri_nombre(){
		return $this->pri_nombre;
	}
	
	public function obtenerSeg_nombre(){
		return $this->seg_nombre;
	}

	public function obtenerTer_nombre(){
		return $this->ter_nombre;
	}

	public function obtenerPri_apellido(){
		return $this->pri_apellido;
	}

	public function obtenerSeg_apellido(){
		return $this->seg_apellido;
	}

	public function obtenerFecha_nac(){
		return $this->fecha_nac;
	}
	
	public function obtenerEmail(){
		return $this->email;
	}

	public function obtenerClave(){
		return $this->clave;
	}
	public function obtenerTelefono(){
		return $this->telefono;
	}

	public function obtenerCod_rol(){
		return $this->cod_rol;
	}
	public function obtenerCod_fac(){
		return $this->cod_fac;
	}

	//Setters

	public function cambiarEmail($email){
		return $this->email=$email;
	}
	public function cambiarClave(){
		return $this->clave;
	}
	public function cambiarTelefono($telefono){
		return $this->telefono=$telefono;
	}

}
