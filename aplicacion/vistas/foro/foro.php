<?php

echo "<br>";
if(Sistema::app()->Acceso()->hayUsuario()){
    echo CHTML::dibujaEtiqueta("div",["style"=>"margin-left:10%;font-size:30px"],"",false);
    echo CHTML::link(CHTML::imagen("/imagenes/24x24/nuevo.png")." Nuevo hilo",Sistema::app()->generaURL(["foro","nuevo"]));
echo CHTML::dibujaEtiquetaCierre("div");
}
if(isset($hilos)){

    echo CHTML::dibujaEtiqueta("div",["clas"=>"col-6"],"",false);
    
    echo CHTML::dibujaEtiqueta("p",[],"",false);
    
    echo CHTML::dibujaEtiqueta("table",["class"=>"table","style"=>"background-color:#84B365;border-radius: 15px;"],"",false);
    foreach ($hilos as $value){
        echo CHTML::dibujaEtiqueta("tr",[],"",false);
        echo CHTML::dibujaEtiqueta("td",["style"=>"text-align:center;font-size:20px"],"",false);
        echo CHTML::dibujaEtiqueta("div",[],$value["usuario"]."<br>".$value["fecha"]);
        echo CHTML::dibujaEtiquetaCierre("td");
        
        echo CHTML::dibujaEtiqueta("td",[],"",false);
        echo CHTML::link($value["titulo"],Sistema::app()->generaURL(["foro","mensajes"],["cod_hilo"=>$value["cod_hilo"]]),
            ["style"=>"color:blue;font-size:30px;","class"=>"col-6"])."\t";
            if(Sistema::app()->Acceso()->getNick()==$value["usuario"] || Sistema::app()->Acceso()->puedePermisoOtros(0)){
                
                echo CHTML::link(CHTML::imagen("/imagenes/24x24/borrar.png"),Sistema::app()->generaURL(["foro","BorrarHilo"],["usuario"=>$value["usuario"],"cod_hilo"=>$value["cod_hilo"]]),[ "onclick" => "return confirm('&iquest;Esta seguro de borrar el hilo?');"]);
            echo CHTML::link(CHTML::imagen("/imagenes/24x24/modificar.png"),Sistema::app()->generaURL(["foro","modificarHilo"],["usuario"=>$value["usuario"],"cod_hilo"=>$value["cod_hilo"]]));
            }
        echo CHTML::dibujaEtiquetaCierre("td");
        echo CHTML::dibujaEtiquetaCierre("tr");
   
     }
     echo CHTML::dibujaEtiquetaCierre("table");
    echo CHTML::dibujaEtiquetaCierre("p");
    echo CHTML::dibujaEtiquetaCierre("div");
    

    

}
