<?php

class menuControlador extends CControlador
{

    public function __construct()
    {
        $value = "";
        if (Sistema::app()->Acceso()->hayUsuario()) {
            $value = Sistema::app()->Acceso()->getNick();
        }
        $this->accionDefecto = "login";
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
                "enlace" => [
                    "perfil",
                    "perfil"
                ],

                "value" => $value
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

    public function accionMenu()
    {
        if (Sistema::app()->Acceso()->hayUsuario()) {
            $menu = new Menu();
            $nombre = $menu->getNombre();
            if (isset($_POST[$nombre])) {
                $menu->setValores($_POST[$nombre]);
                if ($menu->validar()) {
                    $menu->insertarMenu();
                    Sistema::app()->irAPagina([
                        "consultar",
                        "index"
                    ]);
                    return;
                }
            }
            $this->dibujaVista("menu", [
                "menu" => $menu
            ], "Agrega menu");

            return;
        }

        Sistema::app()->irAPagina([
            "login",
            "login"
        ]);
    }

    public function accionModificar()
    {
        if (Sistema::app()->Acceso()->hayUsuario()) {
            if ($_REQUEST["id"]) {
                $id = $_REQUEST["id"];
                $menu = new Menu();
                $fila = $menu->buscarTodos([
                    "where cod_menu= $id"
                ]);
                foreach ($fila as $value) {
                    if ($value["cod_menu"] == $id) {
                        $fila = $value;
                    }
                }
                $nombre = $menu->getNombre();
                if (isset($_POST[$nombre])) {
                    $menu->setValores($_POST[$nombre]);
                    if ($menu->validar()) {
                        $menu->updateMenu();
                        Sistema::app()->irAPagina([
                            "consultar",
                            "index"
                        ]);
                        return;
                    }
                }
                $this->dibujaVista("modificar", [
                    "fila" => $fila,
                    "menu" => $menu
                ], "Modificar menu");
                return;
            }
        }
        Sistema::app()->irAPagina([
            "login",
            "login"
        ]);
    }

    public function accionConsultar()
    {
        if (Sistema::app()->Acceso()->hayUsuario()) {
            
            if ($_REQUEST["id"]) {
                $id = $_REQUEST["id"];
                $menu = new Menu();
                $kcal = Registro::devolverDato(Sistema::app()->Acceso()->getNick())[0]["gasto_kcal"];
                
                $fila = $menu->buscarTodos([
                    "where cod_menu= $id"
                ]);
                foreach ($fila as $value) {
                    if ($value["cod_menu"] == $id) {
                        $fila = $value;
                    }
                }
                $alimentos = strtok($fila["menu"], "-");
                $comida = "";
                while ($alimentos!=false ){
                    $comida .= $alimentos."<br>";
                    $alimentos = strtok("-");
                }
                $conclusion = "";
                if ($kcal < $fila["kcal"]) {
                    $conclusion = "Se ha aportado más kcal de las que necesitas($kcal), por lo que su peso subirá";
                }
                if ($kcal > $fila["kcal"]) {
                    $conclusion = "Se ha aportado menos kcal de las que necesitas($kcal), por lo que su peso bajará";
                }
                $this->dibujaVista("consultar", [
                    "fila" => $fila,
                    "gasto" => $conclusion,
                    "comida" =>$comida
                ], "Consulta menu");
                return;
            }
        }else{
            Sistema::app()->irAPagina([
                "login",
                "login"
            ]);
        }
    }
    public function accionBorrar()
    {
        if (Sistema::app()->Acceso()->hayUsuario()) {
            
            if ($_REQUEST["id"]) {
                $id = $_REQUEST["id"];
                $menu = new Menu();
                $sent = $menu->sentenciaDelete($id);
                $menu->ejecutarSentencia($sent);
                
                Sistema::app()->irAPagina(["consultar","index"]);
                return;
            }
        }else{
            Sistema::app()->irAPagina([
                "login",
                "login"
            ]);
        }
    }
    public function accionDescargar(){
        if (Sistema::app()->Acceso()->hayUsuario()) {
            
            if ($_REQUEST["id"]) {
                $id = $_REQUEST["id"];
               $menu = new Menu();
               $fila=$menu->buscarTodos(["where"=>"cod_menu=".$id]);
               $kcal="";
               $kcal = Registro::devolverDato(Sistema::app()->Acceso()->getNick())[0]["gasto_kcal"];
               $gasto = "";
               if ($kcal < $fila[0]["kcal"]) {
                   $gasto = "Se ha aportado mas kcal de las que necesitas($kcal), por lo que su peso subira";
               }
               if ($kcal > $fila[0]["kcal"]) {
                   $gasto = "Se ha aportado menos kcal de las que necesitas($kcal), por lo que su peso bajara";
               }
               
               $kcal = "-Se aporto un total de ".$fila[0]["kcal"]." kcal. $gasto";
               $mensaje = "El dia ".$fila[0]["fecha"]." se tomo el siguiente menu: \n ".$fila[0]["menu"];
               $mensaje.=$kcal;
               
               $nombreSalida="menu-".$id.".txt";
               header('Content-Type:'.'text/plain');
               header('Content-Disposition:attachment;filename="'.$nombreSalida.'"');
               echo $mensaje;
               
               return;
            }
        }else{
            Sistema::app()->irAPagina([
                "login",
                "login"
            ]);
        }
    }
}