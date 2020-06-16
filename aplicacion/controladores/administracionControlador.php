<?php

class administracionControlador extends CControlador
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
                "enlace" => [
                    "perfil",
                    "perfil"
                ]
            ],
            [

                "texto" => "Administración",
                "enlace" => [
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

    /*
     * public function accionConsultar() {
     * if(Sistema::app()->Acceso()->hayUsuario() && Sistema::app()->Acceso()->puedePermisoOtros(1)){
     * $usuario = new Usuario();
     * $nombre = $usuario->getNombre();
     * if(isset($_POST[$nombre])){
     * $usuario->setValores($_POST[$nombre]);
     * if($usuario->validar()){
     * $usuario->modificarUsuario();
     * Sistema::app()->irAPagina("consultar");
     * }
     * }
     * }
     * ;
     * }
     */
    public function accionConsultar()
    {
        if (Sistema::app()->Acceso()->hayUsuario() && Sistema::app()->Acceso()->puedePermisoOtros(0)) {
            $usu = new Usuario();
            $filas = $usu->buscarTodos([
                "select" => "count(*) as n_filas"
            ]);

            $total = $filas[0]["n_filas"];
            $pagina = 1;
            if (isset($_REQUEST["pag"]))
                $pagina = intval($_REQUEST["pag"]);

            $regPagina = 10;
            if (isset($_REQUEST["reg_pag"]))
                $regPagina = intval($_REQUEST["reg_pag"]);
            if ($regPagina <= 0)
                $regPagina = 10;

            $paginas = ceil($total * 1.0 / $regPagina);

            if ($pagina < 1)
                $pagina = 1;

            if ($pagina > $paginas)
                $pagina = 1;

            $sentLimit = "" . (($pagina - 1) * $regPagina) . ",$regPagina";

            $filas = $usu->buscarTodos([
                "where" => "",
                "limit" => $sentLimit
            ]);

            foreach ($filas as $clave => $valor) {
                // $filas[$clave]["fecha"] = CGeneral::fechaMysqlANormal($filas[$clave]["fecha"]);

                $filas[$clave]["borrado_texto"] = ($filas[$clave]["borrado"] == '1' ? 'Si' : 'No');
                // botones
                $sentencia = "Select nombre from acl_rol where cod_rol = ";
                $sentencia .= $filas[$clave]["cod_rol"];
                $nombreRol = Sistema::app()->BD()
                    ->crearConsulta($sentencia)
                    ->fila();
                $filas[$clave]["rol"] = $nombreRol["nombre"];
                $cadena = CHTML::link(CHTML::imagen('/imagenes/24x24/modificar.png',"modificar"), Sistema::app()->generaURL(array(
                    "administracion",
                    "modificar"
                ), array(
                    "id" => $filas[$clave]["cod_usuario"]
                )));
                $cadena .= CHTML::link(CHTML::imagen('/imagenes/24x24/borrar.png',"borrar"), Sistema::app()->generaURL(array(
                    "administracion",
                    "borrar"
                ), array(
                    "id" => $filas[$clave]["cod_usuario"]
                )), array(
                    "onclick" => "return confirm('&iquest;Esta seguro de borrar el articulo?');"
                ));
                $filas[$clave]["opciones"] = $cadena;
            }
            // definiciones de las cabeceras de las
            // columnas para el CGrid
            $cabecera = array(
                array(
                    "ETIQUETA" => "CODIGO USUARIO",
                    "CAMPO" => "cod_usuario",
                    "ANCHO" => "100px",
                    "ALINEA" => "cen"
                ),
                array(
                    "ETIQUETA" => "NICK",
                    "CAMPO" => "nick",
                    "ANCHO" => "100px",
                    "ALINEA" => "cen"
                ),
                array(
                    "ETIQUETA" => "ROL",
                    "CAMPO" => "rol",
                    "ANCHO" => "100px",
                    "ALINEA" => "cen"
                ),
                array(
                    "ETIQUETA" => "BORRADO",
                    "CAMPO" => "borrado",
                    "ANCHO" => "100px",
                    "ALINEA" => "cen"
                ),

                array(
                    "CAMPO" => "opciones",
                    "ETIQUETA" => " OPERACIONES",
                    "ANCHO" => "100px",
                    "ALINEA" => "cen"
                )
            );

            $urlPaginador = Sistema::app()->generaURL([
                "administracion",
                "consultar"
            ]);
            if (! isset($_GET["id"])) {
                $opcPaginador = array(
                    "URL" => $urlPaginador,
                    "TOTAL_REGISTROS" => $total,
                    "PAGINA_ACTUAL" => $pagina,
                    "REGISTROS_PAGINA" => $regPagina,
                    "TAMANIOS_PAGINA" => array(
                        5 => "5",
                        10 => "10",
                        20 => "20",
                        30 => "30",
                        40 => "40",
                        50 => "50"
                    ),
                    "MOSTRAR_TAMANIOS" => true,
                    "PAGINAS_MOSTRADAS" => 5
                );
                $this->dibujaVista("consultar", [
                    "filas" => $filas,
                    "cabe" => $cabecera,
                    "opcPag" => $opcPaginador
                ], "Lista de mensajes");
                return;
            }
        } else {
            Sistema::app()->irAPagina([
                "inicial",
                "Index"
            ]);
        }
    }
    public function accionModificar() {
        if (Sistema::app()->Acceso()->hayUsuario() && Sistema::app()->Acceso()->puedePermisoOtros(0)) {
            $id ="";
            if(isset($_REQUEST["id"])){
                $id=$_REQUEST["id"];
            }
            
            $usuario = new Usuario();
            $nombre = $usuario->getNombre();
            if(isset($_POST[$nombre])){
                $usuario->setValores($_POST[$nombre]);
                
                if($usuario->validar()){
                    $usuario->modificarUsuario();
                    Sistema::app()->irAPagina(["administracion","consultar"]);
                    return;
                    
                }
                
            }
            $usuario->nick = Sistema::app()->ACLBD()->getNick($id);
            $cod_roles = Sistema::app()->ACLBD()->dameRoles();
            $this->dibujaVista("modificar",["roles"=>$cod_roles,"id"=>$id,"usu"=>$usuario],"Modificar usuario");
            
            
        } else {
            Sistema::app()->irAPagina([
                "inicial",
                "Index"
            ]);
        }
    }
    public function accionBorrar(){
        if (Sistema::app()->Acceso()->hayUsuario() && Sistema::app()->Acceso()->puedePermisoOtros(0)) {
            $id ="";
            if(isset($_REQUEST["id"])){
                $id=$_REQUEST["id"];
            }
            $usuario = new Usuario();
            if($usuario->buscarPor(["where cod_usuario=".$id])){
             $usuario->borrar($id); 
             Sistema::app()->irAPagina(["administracion","consultar"]);
             return;
             
            }
        }
        else {
            Sistema::app()->irAPagina([
                "inicial",
                "Index"
            ]);
        }
    }
}

    