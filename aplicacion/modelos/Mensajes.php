<?php

class Mensajes extends CActiveRecord
{
    
    protected function fijarNombre()
    {
        return 'mensaje';
    }
    protected function fijarTabla(){
        return "mensajes";
    }
    
    protected function fijarAtributos()
    {
        return array(
            "cod_hilo",
            "cod_mensaje",
            "mensaje",
            "usuario"
            
        );
    }
    
    protected function fijarDescripciones()
    {
        return array(
            "cod_hilo" => "Cod_hilo: ",
            "mensaje"=> "Mensaje: ",
            "usuario" => "Usuario: ",
            "cod_mensaje"=> "Cod_mensaje: ",
        );
    }
    
    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "mensaje",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "mensaje",
                "TIPO" => "CADENA",
                "TAMANIO" => 1000,
                "MENSAJE" =>"El mensaje no puede tener más de 1000 caracteres"
            ),
        );
    }
    protected function afterCreate()
    {
        $this->cod_mensaje=0;
        $this->cod_hilo = 0;
        $this->usuario = "";
        $this->mensaje= "";
       
    }
    public function ejecutarInsert() {
        $nick=Sistema::app()->Acceso()->getNick();
        $cod_hilo = CGeneral::addSlashes($this->cod_hilo);
        $mensaje = CGeneral::addSlashes($this->mensaje);
        
        $sent="INSERT INTO mensajes (cod_mensaje, cod_hilo, mensaje, usuario) VALUES (NULL, '$cod_hilo', '$mensaje', '$nick')";
        Sistema::app()->BD()->crearConsulta($sent);
    
    }
    public function borrarMensaje(){
        $mensaje = $this->cod_mensaje;
        $sentMen= "DELETE FROM `mensajes` WHERE cod_mensaje = $mensaje";
        Sistema::app()->BD()->crearConsulta($sentMen);
 
    }
}