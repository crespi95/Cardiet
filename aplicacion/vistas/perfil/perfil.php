<?php

if(Sistema::app()->Acceso()->hayUsuario() 
    && Sistema::app()->ACLBD()->getNick($id)==Sistema::app()->Acceso()->getNick()){
$tabla = new CGrid($cabe, $fila, [
    "class"=>"table","style"=>"background-color:#84B365;border-radius: 15px; text-align:center;font-size:20px"]);
$url = Sistema::app()->generaURL("SubirFoto");
echo "<br>";
echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);


echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]),"",false;
echo $tabla->dibujate();
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");
echo "<br>";
echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-5"]);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::link("Añadir foto de perfil",$url);
echo CHTML::dibujaEtiquetaCierre("div");
}else{
    echo "logueate con un usuario válido";
}