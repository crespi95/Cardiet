<?php

class Usuario extends CActiveRecord
{

    protected function fijarNombre()
    {
        return 'usu';
    }

    protected function fijarTabla()
    {
        return "acl_usuario";
    }

    protected function fijarAtributos()
    {
        return array(
            "cod_usuario",
            "nick",
            "cod_rol",
            "borrado"
        );
    }

    protected function fijarDescripciones()
    {
        return array(
            "cod_usuario" => "Codigo de usuario: ",
            "nick" => "Usuario: ",
            "cod_rol" => "Tipo de permiso: ",
            "borrado" => "Borrado: "
        );
    }

    protected function fijarRestricciones()
    {
        Return array(
            array(
                "ATRI" => "cod_usuario,cod_rol",
                "TIPO" => "REQUERIDO"
            ),
            array(
                "ATRI" => "nick",
                "TIPO" => "CADENA",
                "TAMANIO" => 20
            ),
            array(
                "ATRI" => "cod_rol",
                "TIPO" => "FUNCION",
                "FUNCION" => "validarol"
            ),

            array(
                "ATRI" => "cod_usuario",
                "TIPO" => "FUNCION",
                "FUNCION" => "validaUsuario"
            ),
            array(
                "ATRI" => "borrado",
                "TIPO" => "entero",
                "MIN" => 0,
                "MAX" => 1,
                "MENSAJE"=>"Elige 1 para borrado, 0 para no borrado "
            )
        );
    }

    protected function validaUsuario()
    {
        $cod_usu = CGeneral::addSlashes($this->cod_usuario);
        if (! Sistema::app()->ACLBD()->existeUsuarioCod($cod_usu)) {
            $this->setError("cod_usuario", "Usuario no válido");
        }
    }
    protected function validaRol()
    {
        $cod_rol= CGeneral::addSlashes($this->cod_rol);
        if (! Sistema::app()->ACLBD()->existeRole($cod_rol)) {
            $this->setError("cod_usuario", "Rol no válido");
        }
    }
    public function modificarUsuario() {
        $cod_usu = CGeneral::addSlashes($this->cod_usuario);
        $nick = CGeneral::addSlashes($this->nick);
        $cod_rol = CGeneral::addSlashes($this->cod_rol);
        $borrado = CGeneral::addSlashes($this->borrado);
        $sentUpd= "UPDATE acl_usuario SET
                      
                        cod_rol=".$cod_rol.",borrado=".$borrado."
                        WHERE cod_usuario= ".$cod_usu;
        Sistema::app()->BD()->crearConsulta($sentUpd);
        
    }
    public static function borrar($cod) {
        $cod=CGeneral::addSlashes($cod);
        $sentUpd= "UPDATE acl_usuario SET borrado=1
                        WHERE cod_usuario= ".$cod;
        Sistema::app()->BD()->crearConsulta($sentUpd);
    }
}
