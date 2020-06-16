<?php

	$config=array("CONTROLADOR"=> array("inicial"),
				  "RUTAS_INCLUDE"=>array("aplicacion/modelos"),
				  "URL_AMIGABLES"=>true,
				  "VARIABLES"=>array("autor"=>"alumno daw",
				  					"direccion"=>"C/ carrera madre carmen, 12"),
				  "BD"=>array("hay"=>true,
								"servidor"=>"localhost",
								"usuario"=>"2daw05",
								"contra"=>"2daw",
        				        "basedatos"=>"BD2DAW05"),
        	    "SESION"=>array("controlAutomatico"=>true),
        	    "ACCESO"=>array("controlAutomatico"=>true),
	            "ACL"=>array("hay"=>true,
                        	        "servidor"=>"localhost",
                        	        "usuario"=>"2daw05",
                        	        "contra"=>"2daw",
                        	        "basedatos"=>"BD2DAW05")
        				  );

