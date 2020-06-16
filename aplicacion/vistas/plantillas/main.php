<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $titulo;?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="/estilos/style.css" />

<link rel="icon" type="image/png" href="/imagenes/favicon.png" />
<script src="https://code.jquery.com/jquery-3.4.1.js"
	integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
	crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  

		<?php
if (isset($this->textoHead))
    echo $this->textoHead;
?>
	   
	</head>
<body>
	<div id="todo">
		<header>
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-3 col-3 ">
					<?php if (Sistema::app()->Acceso()->hayUsuario()) {
                        $usuario = Sistema::app()->Acceso()->getNick();
                        $ruta = RUTA_BASE."/imagenes/usuarios/" . $usuario . ".jpg";
                        $imagen = "/imagenes/usuarios/" . $usuario . ".jpg";
                        if(file_exists($ruta)){
                        echo "<img src='".$imagen."' class='img-fluid rounded d-block m-l-none' style='width=100%; height=60%' alt='foto del usuario'>";
                        }
                    }?>
				
  
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-6 ">
					<br> <br> <a href="/index.php"><img src="/imagenes/inicio2.jpg"
						class="img-fluid " style="width: 70%;margin-left:10%" alt="logo"/></a>
				</div>



				<div class="col-lg-3 col-md-3 col-sm-3 col-3 login">
					<br> <br> <br>
				<?php

    if (isset($this->login) && isset($_SESSION)) {
        if (! Sistema::app()->Acceso()->hayUsuario()) {

            foreach ($this->login as $opcion) {

                echo CHTML::link($opcion["texto"], $opcion["enlace"], [
                    "class" => "login"
                ]) . "<br>";
            }
        }
    }

    ?>  
	                  <?php

                if (isset($this->registrar) && isset($_SESSION)) {

                    if (! Sistema::app()->Acceso()->hayUsuario()) {

                        foreach ($this->registrar as $opcion) {

                            echo CHTML::link($opcion["texto"], $opcion["enlace"], [
                                "class" => "login"
                            ]);
                        }
                    }
                }

                ?>  
	                  <?php

                if (isset($this->logout)) {
                    if (Sistema::app()->Acceso()->hayUsuario()) {
                        $usuario = Sistema::app()->Acceso()->getNick();
                        $ruta = RUTA_BASE . "/aplicacion/fotos/usuarios/" . $usuario . ".jpg";
                        foreach ($this->logout as $opcion) {
                            //hidden para guardar usuario para crear cookie JQuery
                            echo CHTML::campoHidden($usuario,$_SESSION[$usuario],["id"=>"cookie"]);
                            echo "Usuario " . $usuario . ", sesión iniciada " . $_SESSION[$usuario] . " veces<br>";
                            echo CHTML::link($opcion["texto"], $opcion["enlace"]);
                        }
                    }
                }

                ?> 
                </div>
			</div>
			<div class="nav nav-pills  navegacion""> 
				
			
				<?php

    if (isset($this->menuizq)) {
        foreach ($this->menuizq as $opcion) {

            if ($opcion["texto"] == "Administración") {
                if (Sistema::app()->Acceso()->hayUsuario() && Sistema::app()->Acceso()->puedePermisoOtros(0)) {
                    echo CHTML::dibujaEtiqueta("div", [
                        "class" => "nav-item"
                    ], "", false);

                    echo CHTML::link($opcion["texto"], $opcion["enlace"], [
                        "class" => "navURL"
                    ]);
                    echo CHTML::dibujaEtiquetaCierre("div");
                }
            } else {
                echo CHTML::dibujaEtiqueta("div", [
                    "class" => "nav-item"
                ], "", false);

                echo CHTML::link($opcion["texto"], $opcion["enlace"], [
                    "class" => "navURL"
                ]);
                echo CHTML::dibujaEtiquetaCierre("div");
            }
        }
        $url ="http://www.meteopedroespinosa.es:3000/?usuario=";
        $url2 = "https://www.meteopedroespinosa.es:8443/";
        if(Sistema::app()->Acceso()->hayUsuario()){
            $usuario=Sistema::app()->Acceso()->getNick();
            $url .=$usuario;
        }else{
            $url.="invitado";
        }
   
        echo CHTML::dibujaEtiqueta("div", [
            "class" => "nav-item"
        ], "", false);
        
        echo CHTML::link("Chat",$url,["target"=>"_blank","class" => "navURL"]);
        echo CHTML::dibujaEtiquetaCierre("div");
       
        echo CHTML::dibujaEtiqueta("div", [
            "class" => "nav-item"
        ], "", false);
        
       // echo CHTML::link("VideoStream",$url2,["target"=>"_blank","class" => "navURL"]);
        echo CHTML::dibujaEtiquetaCierre("div");
    }

    ?>      


				<div class="navegacion">
					<!--	<div><a href="" class="navURL">Inicio</a></div>
				<div><a href="#" class="navURL">Consultar alimentos</a></div>
				<div><a href="#" class="navURL">Añadir registro</a></div>
				<div><a href="#" class="navURL">Consultar registros</a></div>
				<div><a href="#" class="navURL">Editar perfil</a></div>-->
				</div>
		
		</header>
		<!-- #header -->

		<div class="contenido">

			<br> <br>
			<article>
	        		<?php echo $contenido; ?>
	 		
	 			</article>
			<!-- #content -->

		</div>
	
		<footer>
			<h2>E-mail: Ricardo1.cresro@gmail.com - Tlf:666666666</h2>
		</footer>
		<!-- #footer -->

	</div>
	<!-- #wrapper -->
	<link rel="stylesheet"
		href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
		crossorigin="anonymous">

</body>
</html>
