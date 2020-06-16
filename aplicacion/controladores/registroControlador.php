<?php

class registroControlador extends CControlador
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
    public function accionRegistro()
    {
        if(Sistema::app()->Acceso()->hayUsuario()){
            
                Sistema::app()->irAPagina(["inicial","index"]);
            
        }else{
        $reg = new Registro();
        $nombre = $reg->getNombre();
        if(isset($_POST[$nombre])){
           $reg->setValores($_POST[$nombre]);
           if($reg->validar()){
               
               $reg->ejecutarInsert();
               Sistema::app()->irAPagina(["login","login"]);
           }else{
               $this->dibujaVista("registro",["reg"=>$reg],"Registro");
           }
            
        }else{
           $this->dibujaVista("registro",["reg"=>$reg],"Registro");
         }
       
        }
    }
}