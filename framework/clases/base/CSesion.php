<?php 

class CSesion {
    
    public function __construct(){

     
    }

    
    public function crearSesion()
    {
        if (!$this->haySesion())
            session_start();
    }
    
    public function haySesion()
    { 
        return session_status() == PHP_SESSION_ACTIVE? true:false;
    }
    
    public function destruirSesion()
    {
        if ($this->haySesion())
            session_destroy();
    }
    
    public function get($nombre)
    {
       return isset($_SESSION[$nombre])? $_SESSION[$nombre]:null;
    }
    
    public function set($nombre,$valor)
    {
        if (!$this->haySesion())
            return false;
        
        $_SESSION[$nombre] = $valor;
        
        return true;
    }
    
    public function existe($nombre)
    {
        if (!$this->haySesion())
            return false;
        
        return isset($_SESSION[$nombre]);
    }
    
    public function borrar($nombre) 
    {
        if (!$this->haySesion())
            return false;
        
        if (isset($_SESSION[$nombre]))
            unset($_SESSION[$nombre]);
    }
}