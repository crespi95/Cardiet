<?php

class Foro extends CActiveRecord
{
    
    protected function fijarNombre()
    {
        return 'foro';
    }
    protected function fijarTabla(){
        return "hilos";
    }
    
    protected function fijarAtributos()
    {
        return array(
            "cod_hilo",
            "titulo",
            "fecha",
           "usuario"
            
        );
    }
    
    protected function fijarDescripciones()
    {
        return array(
            "cod_hilo" => "Cod_hilo: ",
            "titulo"=> "Titulo: ",
            "fecha" => "Fecha: ",
            "usuario"=> "Usuario: ",
        );
    }
    
    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "titulo",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "titulo",
                "TIPO" => "CADENA",
                "TAMANIO" => 30,
                "MENSAJE" =>"El título debe de tener menos de 30 caracteres"
            ),
        );
    }
    protected function afterCreate()
    {
        $this->fecha=(new DateTime())->format("Y/m/d");
        $this->cod_hilo = 0;
        $this->cod_usuario = 0;
        $this->titulo= "";
       
    }
    public function ejecutarInsert() {
        $nick=Sistema::app()->Acceso()->getNick();
        $mensaje = CGeneral::addSlashes($this->titulo);
        $fecha = $this->fecha;
        
        $sent="INSERT INTO hilos (cod_hilo, titulo, fecha, usuario) VALUES (NULL, '$mensaje', '$fecha', '$nick')";
        Sistema::app()->BD()->crearConsulta($sent);
        
    }
    public function borrarHilo(){
        $hilo = $this->cod_hilo;
        $sentMen= "DELETE FROM `mensajes` WHERE cod_hilo = $hilo";
        Sistema::app()->BD()->crearConsulta($sentMen);
        $sent ="DELETE FROM hilos WHERE cod_hilo = $hilo";
        Sistema::app()->BD()->crearConsulta($sent);
    }
    public function modificarHilo(){
        $hilo = CGeneral::addSlashes($this->cod_hilo);
        $titulo = CGeneral::addSlashes($this->titulo);
        $sent="UPDATE `hilos` SET `titulo` = '$titulo' WHERE cod_hilo = $hilo";
        Sistema::app()->BD()->crearConsulta($sent);
    }
    
    
}