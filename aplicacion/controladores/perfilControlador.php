<?php

class perfilControlador extends CControlador
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
            ],
            [

                "texto" => "Administración",
                "enlace" => [
                    "administracion",
                    "consultar"
                ]
            ],
            [

                "texto" => "Sugerencias",
                "enlace" => [
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

    public function accionPerfil()
    {
        if (Sistema::app()->Acceso()->hayUsuario()) {
            $registro = new Registro();
            $nick = Sistema::app()->Acceso()->getNick();
            $id = Sistema::app()->ACLBD()->getCod_usu($nick);

            $filas = $registro->buscarTodos([
                "where" => "cod_usuario = $id"
            ]);

            foreach ($filas as $clave => $valor) {
                $filas[$clave]["nombre"] = $filas[$clave]["nombre"];
                $filas[$clave]["peso"] = $filas[$clave]["peso"];
                $filas[$clave]["altura"] = $filas[$clave]["altura"];
                $filas[$clave]["gasto_kcal"] = $filas[$clave]["gasto_kcal"];

                // botones

                $cadena = CHTML::link(CHTML::imagen('/imagenes/24x24/modificar.png',"modificar"), Sistema::app()->generaURL(array(
                    "perfil",
                    "modificar"
                ), array()));

                $filas[$clave]["opciones"] = $cadena;
            }

            $cabecera = array(
                array(
                    "ETIQUETA" => "NOMBRE",
                    "CAMPO" => "nombre",
                    "ANCHO" => "100px",
                    "ALINEA" => "cen"
                ),
                array(
                    "ETIQUETA" => "PESO",
                    "CAMPO" => "peso",
                    "ANCHO" => "100px",
                    "ALINEA" => "cen"
                ),
                array(
                    "ETIQUETA" => "ALTURA",
                    "CAMPO" => "altura",
                    "ANCHO" => "100px",
                    "ALINEA" => "cen"
                ),
                array(
                    "ETIQUETA" => "CALORÍAS",
                    "CAMPO" => "gasto_kcal",
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

            $this->dibujaVista("perfil", [
                "id" => $id,
                "cabe" => $cabecera,
                "fila" => $filas
            ], "Perfil");
            return;

            $nombre = $registro->getNombre();
            if (isset($_POST[$nombre])) {
                $registro->setValores($_POST[$nombre]);
                if ($registro->validar()) {
                    $registro->ejecutarUpdate();
                }
            }
        } else {

            Sistema::app()->irAPagina([
                "login",
                "login"
            ]);
        }
    }

    public function accionModificar()
    {
        if (! Sistema::app()->Acceso()->hayUsuario()) {
            Sistema::app()->irAPagina("inicial, index");
            return;
        }
        $perfil = new Perfil();
        $nombre = $perfil->getNombre();
        $id = Sistema::app()->Acceso()->getNick();

        if (isset($_POST["contra"])) {
            $perfil->setValores($_POST[$nombre]);
            if ($perfil->validar()) {

                $perfil->modificarContra();
                Sistema::app()->irAPagina("perfil", "perfil");
                return;
            }
        }
        if (isset($_POST[$nombre])) {
            $perfil->setValores($_POST[$nombre]);

            if ($perfil->validar()) {

                $perfil->ejecutarUpdate();
                Sistema::app()->irAPagina("perfil", "perfil");
                return;
            }
        }
        $this->dibujaVista("modificar", [
            "perfil" => $perfil,
            "id" => $id
        ], "Modificar perfil");
    }

    public function accionSubirFoto()
    {
        if (! Sistema::app()->Acceso()->hayUsuario()) {
            Sistema::app()->irAPagina(["login","login"]);
            return;
        }
        $usuario = Sistema::app()->Acceso()->getNick();
        if ($_POST) {
            if(isset($_FILES["Foto"])){
                if($_FILES["Foto"]["error"]!=0){
                    echo "Error ".$_FILES["Foto"]["error"];
                    return;
                }
                
            if ((($_FILES["Foto"]["type"] == "image/gif") ||
                ($_FILES["Foto"]["type"] == "image/jpeg") ||
                ($_FILES["Foto"]["type"] == "image/jpg") ||
                ($_FILES["Foto"]["type"] == "image/JPG") ||
  
                ($_FILES["Foto"]["type"] == "image/pjpeg"))
               ) {
                   // && ($_FILES["Foto"]["size"] < 1000000)
                    if(move_uploaded_file($_FILES["Foto"]["tmp_name"],
                        RUTA_BASE."/imagenes/usuarios/" . $usuario . ".jpg")){
                            Sistema::app()->irAPagina(["perfil","perfil"]);
                            return;
                    }
              
                }
                else{
                    echo "<script>alert('Formato no válido')</script>";
                }
            }
            else{
                echo "Error, no se ha subido la foto";
                return ;
            }
        }
        $this->dibujaVista("foto",[],"Añadir foto de perfil");
    }
}
