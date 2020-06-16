<?php 

class Login extends CActiveRecord
{
    
    protected function fijarNombre()
    {
        return 'log';
    }
    protected function fijarTabla(){
        return "rol_usuario";
    }
    
    protected function fijarAtributos()
    {
        return array(
            "nick",
            "contrasena",
            "nombre",
            "puedeAcceder",
            "puedeConfigurar",
            "permiso1"
           
        );
    }
    
    protected function fijarDescripciones()
    {
        return array(
            "nick" => "Usuario: ",
            "nombre"=> "Nombre: ",
            "contrasena" => "Contraseña: ",
            "puedeAcceder"=> "Puede acceder: ",
            "puedeConfigurar"=> "Puede configurar: ",
            "permiso1"=> "Administrador: ",
            
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
                "ATRI" => "nick",
                "TIPO" => "CADENA",
                "TAMANIO" => 20,
                "MENSAJE" =>"El nombre de usuario debe tener menos de 20 caracteres"
            ),
            array(
                "ATRI" => "contrasena",
                "TIPO" => "CADENA",
                "TAMANIO" => 20
            ),
            array(
                "ATRI" => "nick",
                "TIPO" => "FUNCION",
                "FUNCION" => "logueo"
            ),
        );
    }
    
    
    protected function afterCreate()
    {
        $this->nick = "";
        $this->contrasena = "";
        $this->puedeAcceder = 0;
        $this->puedeConfigurar = 0;
        $this->permiso1 =[0,0,0,0,0,0,0,0,0,0];
    }
   
   protected function logueo() {
       if(Sistema::app()->ACLBD()->esValido($this->nick, md5("!!!".$this->contrasena))){
           $puedeAcceder=false;
           $puedeConfigurar=false;
           $aux=[0,0,0,0,0,0,0,0,0,0];
           $nombre="";
           Sistema::app()->ACLBD()->getPermisos($this->nick,$puedeAcceder,$puedeConfigurar);
           $aux[0]=Sistema::app()->ACLBD()->getPermisoOtros($this->nick, 1);
           $nombre = Sistema::app()->ACLBD()->getNombre($this->nick);
           $this->nombre = $nombre;
           $this->puedeAcceder=$puedeAcceder;
           $this->puedeConfigurar = $puedeConfigurar;
           $this->permiso1=$aux;
           Sistema::app()->Acceso()->registrarUsuario($this->nick, $this->nombre, $this->puedeAcceder, $this->puedeConfigurar, $this->permiso1);
           if (! isset($_COOKIE[$this->nick])) {
               setcookie($this->nick, 1, time() + 60 * 60 * 24 * 365);
               $_SESSION[$this->nick]=1;
           } else {
               $contador = $_COOKIE[$this->nick] + 1;
               setcookie($this->nick, $contador, time() + 60 * 60 * 24 * 365);
               $_SESSION[$this->nick]=$contador;
           }
       }else{
       $this->setError("nick", "Usuario o contraseña no válido");
       
       }
       
   }
    

}