<?php

class Perfil extends CActiveRecord{
    
    
    protected function fijarNombre()
    {
        return 'reg';
    }
    protected function fijarTabla(){
        return "registro";
    }
    
    protected function fijarAtributos()
    {
        return array(
            "nick",
            "contrasena",
            "edad",
            "peso",
            "altura",
            "cod_usu"
            
            
            
            
        );
    }
    
    protected function fijarDescripciones()
    {
        return array(
            "nick" => "Usuario: ",
            "contrasena" => "Contraseña: ",
            "edad"=> "Edad: ",
            "peso"=> "Peso(Kg): ",
            "altura"=> "Altura(cm): ",
            "cod_usu"=>"Codigo de usuario: "
            
        );
    }
    
    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "nick,contrasena",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "nick,nombre",
                "TIPO" => "CADENA",
                "TAMANIO" => 20,
                "MENSAJE" =>"El nombre debe tener menos de 20 caracteres"
            ),
            array(
                "ATRI" => "nick,",
                "TIPO" => "FUNCION",
                "FUNCION"=>"validanick",
                
            ),
            
            array(
                "ATRI" => "contrasena",
                "TIPO" => "CADENA",
                "TAMANIO" => 20,
                "MENSAJE"=>"La contraseña debe tener menos de 20 caracteres"
            ),
            array(
                "ATRI" => "edad,altura",
                "TIPO" => "ENTERO",
                "MIN" => "0"
            ),
            array(
                "ATRI" => "edad",
                "TIPO" => "ENTERO",
                "MAX" => "100",
                "MENSAJE"=>"Introduce una edad inferior a 100"
            ),
            array(
                "ATRI" => "altura",
                "TIPO" => "ENTERO",
                "MAX" => "250",
                "MENSAJE"=>"Introduce una altura inferior a 250cm "
            ),
            array(
                "ATRI" => "peso",
                "TIPO" => "REAL",
                "MIN" => "0",
                "MENSAJE"=>"Introduce un peso superior a 0kg"
            ),
            
        );
    }
    
    protected function validanick(){
        $nick=CGeneral::addSlashes($this->nick);
        $sentencia = "Select cod_usuario from acl_usuario where nick='".$nick."'";
        $filas =  Sistema::app()->BD()->crearConsulta($sentencia)->numFilas();
        if($filas==1){
            return true;
        }
        $this->setError("nick", "Usuario no encontrado");
    }
    
    
    protected function afterCreate()
    {
        $this->nick = "";
        $this->contrasena = "";
        $this->nombre = "";
        $this->peso = 0;
        $this->altura =0;
        $this->edad =0;
    }
    protected function cod_usuario($nick) {
        $sentCod = "Select cod_usuario from acl_usuario where nick='".$nick."'";
        $cod_usuario =   Sistema::app()->BD()->crearConsulta($sentCod)->fila();
        return $cod_usuario["cod_usuario"];
    }
    
  
    
    public function ejecutarUpdate(){
        $nick=CGeneral::addSlashes($this->nick);
        $cod_usuario=self::cod_usuario($nick);
        $altura=CGeneral::addSlashes($this->altura);
        $edad=CGeneral::addSlashes($this->edad);
        $peso=CGeneral::addSlashes($this->peso);
        $gastokcal=66+(13.75*$peso)+(5*$altura)-(6.75*$edad)+700;
        $cod_usuario= self::cod_usuario($nick);
        
        
        
        $sentUpd= "UPDATE registro SET
                        edad=".$edad.",altura=".$altura.",
                        peso=".$peso.",gasto_kcal=".$gastokcal."
                        WHERE cod_usuario= ".$cod_usuario;
        Sistema::app()->BD()->crearConsulta($sentUpd);
    }
    public function modificarContra(){
        
        $nick=CGeneral::addSlashes($this->nick);
        $contrasena=CGeneral::addSlashes($this->contrasena);
        Sistema::app()->ACLBD()->setContrasena($nick, $contrasena);
    }
    public static function devolverDato($nick,$where="") {
        
        $sent = "Select * from registro where nombre='".$nick."'";
        if($where){
            $sent=" and ".$where;
        }
        $datos = Sistema::app()->BD()->crearConsulta($sent)->filas();
        return $datos;
    }
    
    
}