<?php
class Equipo{
    private $cod_equ;
    private $marca;
    private $valor;
    private $estado;
    private $descripcion;
    private $cod_sal;
    private $cod_disp;

    public function __construct($cod_equ,$marca,$valor,$estado,$descripcion,$cod_sal,$cod_disp)
    {
        $this->cod_equ = $cod_equ;
        $this->marca = $marca;
        $this->valor = $valor;
        $this->estado = $estado;
        $this->descripcion = $descripcion;
        $this->cod_sal = $cod_sal;
        $this->cod_disp = $cod_disp;
    }
    //GETTERS
    public function obtenerCod_equ(){
        return $this->cod_equ;
    }
    public function obtenerMarca(){
        return $this->marca;
    }
    public function obtenerValor(){
        return $this->valor;
    }
    public function obtenerEstado(){
        return $this->estado;
    }
    public function obtenerDescripcion(){
        return $this->descripcion;
    }
    public function obtenerCod_sal(){
        return $this->cod_sal;
    }
    public function obtenerCod_disp(){
        return $this->cod_disp;
    }    
    //SETTERS
    public function cambiarCod_equ($cod_equ){
        return $this->cod_equ = $cod_equ;
    }
    public function cambiarMarca($marca){
        return $this->marca = $marca;
    }
    public function cambiarValor($valor){
        return $this->valor = $valor;
    }
    public function cambiarEstado($estado){
        return $this->estado = $estado;
    }
    public function cambiarDescripcion($descripcion){
        return $this->descripcion=$descripcion;
    }
    public function cambiarCod_sal($cod_sal){
        return $this->cod_sal=$cod_sal;
    }
    public function cambiarCod_disp($cod_disp){
        return $this->cod_disp=$cod_disp;
    }  
   
}