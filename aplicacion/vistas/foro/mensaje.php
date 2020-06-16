<?php

echo "<br>";

if(isset($mensajes)){
    
    echo CHTML::dibujaEtiqueta("div",[],"",false);
    
    echo CHTML::dibujaEtiqueta("p",[],"",false);
    
    echo CHTML::dibujaEtiqueta("table",[],"",false);
    if(count($mensajes)==0){
        echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
        echo CHTML::dibujaEtiqueta("div",["class"=>"col-4"],"");
        echo CHTML::dibujaEtiqueta("p",["class"=>"col-3","style"=>"font-size:20px"],"No existe ningún mensaje");
       
        echo CHTML::dibujaEtiquetaCierre("div");
        
    }else{
        echo CHTML::dibujaEtiqueta("table",["class"=>"table","style"=>"width: 100%;table-layout:auto;background-color:#84B365;border-radius: 15px;"],"",false);
    foreach ($mensajes as $value){

    
    echo CHTML::dibujaEtiqueta("tr",[],"",false);
    echo CHTML::dibujaEtiqueta("td",["style"=>"text-align:center; font-size:24px;width:15%"],$value["usuario"]);
   
    //echo CHTML::dibujaEtiqueta("td",[],$value["usuario"]);
    echo CHTML::dibujaEtiqueta("td",["style"=>"text-align:left;padding-left:10%; font-size:20px;"],"",false);
    if(Sistema::app()->Acceso()->getNick()==$value["usuario"] || Sistema::app()->Acceso()->puedePermisoOtros(0)){
        
        echo CHTML::link(CHTML::imagen("/imagenes/24x24/borrar.png"),Sistema::app()->generaURL(["foro","BorrarMensaje"],["usuario"=>$value["usuario"],"cod_hilo"=>$value["cod_hilo"],"cod_mensaje"=>$value["cod_mensaje"]]),[ "onclick" => "return confirm('&iquest;Esta seguro de borrar el hilo?');"])."  - ";
        
        
        
    }
    echo $value["mensaje"];
           
    echo CHTML::dibujaEtiquetaCierre("td");
    echo CHTML::dibujaEtiquetaCierre("tr");
    
   
  
        
        echo CHTML::dibujaEtiquetaCierre("tr");
        
    }
    }
    echo CHTML::dibujaEtiquetaCierre("table");
    echo CHTML::dibujaEtiquetaCierre("p");
    echo CHTML::dibujaEtiquetaCierre("div");
    
    
    if(Sistema::app()->Acceso()->hayUsuario()){
        
        echo CHTML::iniciarForm();
        echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
        echo CHTML::dibujaEtiqueta("div",["class"=>"col-3"],"");
        
        echo CHTML::modeloHidden($modelo, "cod_hilo",["value"=>$hilo]);
        echo CHTML::modeloLabel($modelo, "mensaje")."<br>";
        echo CHTML::modeloTextArea($modelo, "mensaje",["cols"=>50,"rows"=>10])."<br>";
        
        echo CHTML::dibujaEtiqueta("div",["class"=>"col-3"],"",false);
        echo CHTML::campoBotonSubmit("Enviar");
        echo CHTML::dibujaEtiquetaCierre("div");
        echo CHTML::dibujaEtiquetaCierre("div");
        echo CHTML::finalizarForm();
    }
    
}

