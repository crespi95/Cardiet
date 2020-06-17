<?php

class foroControlador extends CControlador
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
            ],
            [

                "texto" => "Sugerencias",
                "enlace" => [
                    "correo",
                    "index"
                ]
            ],
            [

                "texto" => "Foro",
                "enlace" => [
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
        $foro = new Foro();
        $hilos = $foro->buscarTodos();

        $this->dibujaVista("foro", [
            "hilos" => $hilos
        ], "Foro");

        return;
    }

    public function accionNuevo()
    {
        if (Sistema::app()->Acceso()->hayUsuario()) {
            $foro = new Foro();
            $nombre = $foro->getNombre();
            $usuario = Sistema::app()->Acceso()->getNick();
            if (isset($_POST[$nombre])) {
                $foro->setValores($_POST[$nombre]);
                if ($foro->validar()) {
                    $foro->ejecutarInsert();
                }

                Sistema::app()->irAPagina("foro,index");
                return;
            }

            $this->dibujaVista("nuevo", [
                "modelo" => $foro
            ], "Nuevo hilo");

            return;
        }
        Sistema::app()->irAPagina([
            "login",
            "login"
        ]);
    }

    public function accionMensajes()
    {
        $mensaje = new Mensajes();
        $nombre = $mensaje->getNombre();
        if (Sistema::app()->Acceso()->hayUsuario()) {
            if (isset($_POST[$nombre])) {
                $mensaje->setValores($_POST[$nombre]);
                if ($mensaje->validar()) {
                    $mensaje->ejecutarInsert();
                }
            }
        }
        if (isset($_GET["cod_hilo"])) {
            $hilo = $_GET["cod_hilo"];

            $mensajes = $mensaje->buscarTodos([
                "where" => "cod_hilo=" . $hilo
            ]);
            $this->dibujaVista("mensaje", [
                "mensajes" => $mensajes,
                "hilo" => $hilo,
                "modelo" => $mensaje
            ], "Foro");
            return;
        }
    }

    public function accionBorrarHilo()
    {
        $foro = new Foro();
        $nombre = $foro->getNombre();
        if (isset($_GET["usuario"]) && isset($_GET["cod_hilo"])) {
            if (Sistema::app()->Acceso()->hayUsuario() && Sistema::app()->Acceso()->getNick() == $_GET["usuario"]) {
                $usuario = $_GET["usuario"];
                $hilo = $_GET["cod_hilo"];
                if ($foro->buscarPor([
                    "where" => "cod_hilo='$hilo' and usuario='$usuario'"
                ])) {
                    $foro->borrarHilo();

                    $hilos = $foro->buscarTodos();
                    $this->dibujaVista("foro", [
                        "hilos" => $hilos
                    ], "Foro");
                    return;
                }
            }
        }
    }

    public function accionModificarHilo()
    {
        $foro = new Foro();
        $nombre = $foro->getNombre();
        if (isset($_POST[$nombre])) {
            $foro->setValores($_POST[$nombre]);
            if ($foro->validar()) {
                $foro->modificarHilo();

                Sistema::app()->irAPagina([
                    "foro",
                    "index"
                ]);
                return;
            }
        }
        if (isset($_GET["usuario"]) && isset($_GET["cod_hilo"])) {
            if (Sistema::app()->Acceso()->hayUsuario() && Sistema::app()->Acceso()->getNick() == $_GET["usuario"]) {
                $usuario = $_GET["usuario"];
                $hilo = $_GET["cod_hilo"];
                $hilos = $foro->buscarTodos();
                $this->dibujaVista("modificarHilo", [
                    "hilo" => $hilo,
                    "modelo" => $foro
                ], "Foro");
                return;
            }
        }
    }

    public function accionBorrarMensaje()
    {
        $mensaje = new Mensajes();

        $nombre = $mensaje->getNombre();
        if (isset($_GET["usuario"]) && isset($_GET["cod_hilo"])) {
            if (Sistema::app()->Acceso()->hayUsuario() && Sistema::app()->Acceso()->getNick() == $_GET["usuario"]) {
                $usuario = $_GET["usuario"];
                $cod_mensaje = $_GET["cod_mensaje"];
                $hilo = $_GET["cod_hilo"];
                if ($mensaje->buscarPor([
                    "where" => "cod_mensaje='$cod_mensaje' and usuario='$usuario'"
                ])) {
                    $mensaje->borrarMensaje();
                    $mensajes = $mensaje->buscarTodos([
                        "where" => "cod_hilo=" . $hilo
                    ]);
                    Sistema::app()->irAPagina(["foro","mensajes"], [
                       
                        "cod_hilo" => $hilo,
                  
                    ], "Foro");
                    return;
                }
            }
        }
    }
}
