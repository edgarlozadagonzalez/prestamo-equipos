<?php
class Prestamo
{
    private $cod_pres;
    private $fecha_inicio;
    private $fecha_fin;
    private $cod_per;
    private $cod_equ;

    public function __construct($cod_pres, $fecha_inicio,$fecha_fin,$cod_per,$cod_equ)
    {
        $this->cod_pres = $cod_pres;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->cod_per= $cod_per;
        $this->cod_equ = $cod_equ;
        
    }
    //GETTERS
    public function obtenerCod_pres(){
        return $this->cod_pres;
    }
    public function obtenerFecha_inicio(){
        return $this->fecha_inicio;
    }
    public function obtenerFecha_fin(){
        return $this->fecha_fin;
    }
    public function obtenerCod_per(){
        return $this->cod_per;
    }
    public function obtenerCod_equ(){
        return $this->cod_equ;
    }
}