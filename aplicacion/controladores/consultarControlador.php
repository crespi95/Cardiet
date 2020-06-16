<?php

class consultarControlador extends CControlador
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

    public function accionIndex()
    {
        $cod_usuario = "";
        $men = new Menu();
        $sentWhere = "";


        if (Sistema::app()->Acceso()->hayUsuario()) {
            $nick = Sistema::app()->Acceso()->getNick();
            $id = Sistema::app()->ACLBD()->getCod_usu($nick);
            $sentWhere = "cod_usuario = $id";

            if (isset($_REQUEST["usu"])) {
                $usu = mb_strtoupper(trim($_REQUEST["usu"]));
                if ($usu != "") {
                    $datos["usu"] = $usu;
                    $usu = CGeneral::addSlashes($usu);
                    if ($sentWhere != "")
                        $sentWhere .= " and ";
                    $sentWhere .= "usuario like '%$usu%'";
                }
            }

            // obtengo totales y opciones de filtrado
            $filas = $men->buscarTodos([
                "select" => "count(*) as n_filas",
                "where" => $sentWhere
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

            $filas = $men->buscarTodos([
                "where" => $sentWhere,
                "limit" => $sentLimit
            ]);

            foreach ($filas as $clave => $valor) {
                $filas[$clave]["fecha"] = CGeneral::fechaMysqlANormal($filas[$clave]["fecha"]);

                // botones
                $cadena = CHTML::link(CHTML::imagen("/imagenes/24x24/ver.png","consultar"), Sistema::app()->generaURL(array(
                    "menu",
                    "consultar"
                ), array(
                    "id" => $filas[$clave]["cod_menu"]
                )));
                $cadena .= CHTML::link(CHTML::imagen('/imagenes/24x24/modificar.png',"modificar"), Sistema::app()->generaURL(array(
                    "menu",
                    "modificar"
                ), array(
                    "id" => $filas[$clave]["cod_menu"]
                )));
                $cadena .= CHTML::link(CHTML::imagen('/imagenes/24x24/borrar.png',"borrar"), Sistema::app()->generaURL(array(
                    "menu",
                    "borrar"
                ), array(
                    "id" => $filas[$clave]["cod_menu"]
                )), array(
                    "onclick" => "return confirm('&iquest;Esta seguro de borrar el menu?');"
                ));
                $cadena .= CHTML::link(CHTML::imagen('/imagenes/24x24/guardar.png',"descargar"), Sistema::app()->generaURL(array(
                    "menu",
                    "descargar"
                ), array(
                    "id" => $filas[$clave]["cod_menu"]
                )));
                
                $filas[$clave]["opciones"] = $cadena;
            }
            // definiciones de las cabeceras de las
            // columnas para el CGrid
            $cabecera = array(
                array(
                    "ETIQUETA" => "FECHA",
                    "CAMPO" => "fecha",
                    "ANCHO" => "100px",
                    "ALINEA" => "cen"
                ),
                array(
                    "ETIQUETA" => "CALORÍAS",
                    "CAMPO" => "kcal",
                    "ANCHO" => "200px",
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
                "consultar",
                "index"
            ]);
            if (! isset($_GET["id"])) {
                $opcPaginador = array(
                    "URL" => $urlPaginador,
                    "TOTAL_REGISTROS" => $total,
                    "PAGINA_ACTUAL" => $pagina,
                    "REGISTROS_PAGINA" => $regPagina,
                    "TAMANIOS_PAGINA" => array(
                        1 => "Diario",
                        7 => "Semanal",
                       
                    ),
                    "MOSTRAR_TAMANIOS" => true,
                    "PAGINAS_MOSTRADAS" => 5
                );
                $this->dibujaVista("index", [

                    "filas" => $filas,
                    "cabe" => $cabecera,
                    "opcPag" => $opcPaginador
                ], "Lista de mensajes");
                return;
            }
        }
        Sistema::app()->irAPagina([
            "login",
            "login"
        ]);
    }
}
