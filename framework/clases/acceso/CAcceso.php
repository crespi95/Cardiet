<?php
class CAcceso {
    // defino las propiedades de la clase
    private $_validado;
    private $_nick;
    private $_nombre;
    private $_puedeAcceder;
    private $_puedeConfigurar;
    private $_otrosPermisos=[];
    
    private $_Acceso;
    
    
    
    // constructor
    public function __construct(){
        $this->_validado = false; //siempre tiene que tener una inicializacion
        
         // partiendo de los datos de sesión compruebo si está validado
         // para tomar los valores del usuario registrado
         if(isset($_SESSION["usuario"]["validado"]))
         {  
            $this->_validado=$_SESSION["usuario"]["validado"];
            if ($this->_validado)
            {
                $this->_nick           =$_SESSION["usuario"]["nick"];
                $this->_nombre         =$_SESSION["usuario"]["nombre"];
                $this->_puedeAcceder   =$_SESSION["usuario"]["puedeAcceder"];
                $this->_puedeConfigurar=$_SESSION["usuario"]["puedeConfigurar"];
                $this->_otrosPermisos  =$_SESSION["usuario"]["permisos"];
            }//if validado
         }//ifisset   
    }//constructor
    
    // métodos de instancia
    /**
     * Sirve para registrar un usuario en la aplicación. 
     *  Almacena los valores en las propiedades apropiadas, 
        y en la sesión, para guardar en la sesión la 
        información del usuario validado
     * @param  $nick
     * @param  $nombre
     * @param  $puedeAcceder
     * @param  $puedeConfigurar
     * @param  $otrosPermisos
     */
    public function registrarUsuario( $nick, $nombre, $puedeAcceder, $puedeConfigurar,$otrosPermisos)
    {
         
      // asigno los datos pasados por parámetros y valido como registrado
        $this->_validado       = true;
        $this->_nick           = $nick;
        $this->_nombre         = $nombre;
        $this->_puedeAcceder   = $puedeAcceder;
        $this->_puedeConfigurar= $puedeConfigurar;
        $this->_otrosPermisos  = $otrosPermisos;
       
       if (isset($_SESSION)) // para asegurar que hay una sesión y recoger sus datos solo si hay
      {   
        // doy la información del usuario registrado a la sesión de éste
        $_SESSION["usuario"]["validado"]       = true;
        $_SESSION["usuario"]["nick"]           = $this->_nick;
        $_SESSION["usuario"]["nombre"]         = $this->_nombre;
        $_SESSION["usuario"]["puedeAcceder"]   = $this->_puedeAcceder;
        $_SESSION["usuario"]["puedeConfigurar"]= $this->_puedeConfigurar;
        $_SESSION["usuario"]["permisos"]       = $this->_otrosPermisos;
        return true;
      }
    //  else {return false;}
      return false;
    }//registrarUsuario()
    
    /**
     * Hace que no haya ningún usuario registrado en el sistema
     */
    public function quitarRegistroUsuario()
    {
        // unset($_SESSION["validado"]);
        
        $this->_validado = false;
        if (isset($_SESSION)) // para asegurar que hay una sesión y recoger sus datos solo si hay
        {
            // para no guardar la información del usuario si no tiene la sesión de éste
            $_SESSION["usuario"]["validado"] = false;
        }
            
    }// quitarRegistro()
    
    /**
     *  Devuelve true si hay un usuario validado 
     *  y false en caso contrario
     */
    public function hayUsuario()
    {
        return ($this->_validado);
    }//hayUsuario()
    
    /**
     * Devuelve true si puede acceder el usuario validado 
     * y false en caso contrario
     */
    public function puedeAcceder()
    {
       // primero miro si está validado correctamente el usuario
      if ($this->hayUsuario())
      {
         return $this->_puedeAcceder;
      }//if     
      return false;    
    }// puedeAcceder()
    
    /**
     * Devuelve true si puede configurar el usuario validado
     * y false en caso contrario
     */
    public function puedeConfigurar()
    {
      // primero miro si está validado correctamente el usuario
     if ($this->hayUsuario())
       return $this->_puedeConfigurar;
     return false;
    }//puedeConfigurar()
    
    /**
     * Devuelve true si tiene el permiso $numero.
     * @param $numero
     */
    public function puedePermisoOtros($numero)
    {
        if ($this->hayUsuario())
            return (isset($this->_otrosPermisos[$numero]) &&
                        $this->_otrosPermisos[$numero]); 
        return false;
    }
    
    /**
     * devuelve el Nick del usuario registrado
     */
    public function getNick()
    {
       // compruebo si está validado
       if($this->hayUsuario())
       {
           return $this->_nick;
       }
       return false;
    }//getNick()
    
    /**
     * devuelve el nombre del usuario registrado
     */
    public function getNombre()
    {
       if($this->hayUsuario())
       {
         return $this->_nombre;    
       }
      return false; 
    }//getNombre()
    
}// class 