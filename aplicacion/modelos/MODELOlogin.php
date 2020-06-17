<?php 

class MODELOlogin extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'log';
    }

    protected function fijarAtributos()
    {
        return array(
            "nick",
            "contrasenia",
            "puedeAcceder",
            "puedeConfigurar",
            "permiso1",
    
            
        );
    }

    protected function fijarDescripciones()
    {
        return array(
            "nick" => "Usuario: ",
            "contrasenia" => "Contraseña: ",
            "puedeAcceder"=> "Puede acceder: ",
            "puedeConfigurar"=> "Puede configurar: ",
            "permiso1"=> "Administrador: ",

        );
    }

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "nick,contrasenia,puedeAcceder,puedeConfigurar,permiso1",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "nick",
                "TIPO" => "CADENA",
                "TAMANIO" => 20,
                "MENSAJE" =>"El nombre de usuario debe tener menos de 20 caracteres"
            ),
            array(
                "ATRI" => "contrasenia",
                "TIPO" => "CADENA",
                "TAMANIO" => 20
            ),
            array(
                "ATRI" => "contrasenia",
                "TIPO" => "FUNCION",
                "FUNCION" => "comprobar"
            ),
            array(
                "ATRI"=> "puedeAcceder,puedeConfigurar,permiso1",
                "TIPO"=> "ENTERO",
                "MIN"=>0,
                "MAX"=>1
            )
        );
    }
  

    protected function afterCreate()
    {
        $this->nick = "";
        $this->contrasenia = "";
    }

    public function comprobar()
    {
    
        if ($this->contrasenia!="c-".$this->nick)
            $this->setError("nick", "usuario o contraseña incorrectos");
    }

}