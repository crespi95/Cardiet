<?php
class correoControlador extends CControlador
{
    
    public function __construct()
    {
  
    
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
                
        
            ],[
                
                "texto"=> "Administración",
                "enlace"=>[
                    "administracion",
                    "consultar"
                ]
            ],
            [    
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
                    "login",
                    "login"
                ]
            ]
        ];
        $this->registrar = [
            [
                "texto" => "Registrar",
                "enlace" => [
                    "registro",
                    "registro"
                ]
            ]
        ];
        $this->logout = [
            [
                "texto" => "Logout",
                "enlace" => [
                    "login",
                    "logout"
                ]
            ]
        ];
    }
    
    public function accionIndex()
    {
        $this->dibujaVista("correo",[],"Sugerencias");
    }
    
}