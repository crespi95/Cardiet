<?php

class loginControlador extends CControlador
{
    public function __construct()
    {
        $value = "";
    if(Sistema::app()->Acceso()->hayUsuario()){
        $value=Sistema::app()->Acceso()->getNick();
    }
        $this->accionDefecto="login";
        $this->menuizq = [
            [
                "texto" => "Inicio",
                "enlace" => [
                    "inicial",
                    "index"
                ]
            ],
            [
                "texto" => "Consultar registros",
                "enlace" => [
                    "consultar",
                    "index"
                ]
            ],
            
            
            
            [
                "texto" => "Añadir menu",
                "enlace" => [
                    "menu",
                    "menu"
                ]
            ], 
            [
                "texto" => "Perfil",
                "enlace" => ["perfil","perfil"],
                
                "value"=> $value
            ],[
                
                "texto"=> "Administración",
                "enlace"=>[
                    "administracion",
                    "consultar"
                ]
            ],[
                
                "texto"=> "Sugerencias",
                "enlace"=>[
                    "correo",
                    "index"
                ]
            ], [
                
                "texto"=> "Foro",
                "enlace"=>[
                    "foro",
                    "index"
                ]
            ]
        ];
        $this->login = [
            [
                "texto" => "Login",
                "enlace" => [
                    "login","login"]
            ]];
        $this->registrar =[
            [
                "texto" => "Registrar",
                "enlace" => [
                    "registro","registro"]
            ]
            
        ];
        $this->logout =[
            [
                "texto" => "Logout",
                "enlace" => [
                    "login","logout"]
            ]
            
        ];
    }
    public function accionLogin()
    {
        if(Sistema::app()->Acceso()->hayUsuario()){
        
        Sistema::app()->irAPagina(["inicial","index"]);
        
    }else{
        $log = new Login();
        $nombre=$log->getNombre();
        if (isset($_POST[$nombre]))
        {
            $log->setValores($_POST[$nombre]);
            
            if ($log->validar())
            {
                
                Sistema::app()->irAPagina(["inicial","index"]);
                return;
            }
            
        }
        
        $this->dibujaVista("login",["log"=>$log],"Pagina de login");
        
    
        }
    }
    public function accionLogout()
    {
        
      
        if(Sistema::app()->Acceso()->hayUsuario()){
           
           Sistema::app()->Acceso()->quitarRegistroUsuario();
            
        }
            Sistema::app()->irAPagina(["inicial"]);

            
        
    }
    
    
}
