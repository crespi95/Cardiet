<?php
if (Sistema::app()->Acceso()->hayUsuario()) {
    if (count($filas) != 0) {
        $this->textoHead = CPager::requisitos();

        $tabla = new CGrid($cabe, $filas, [
            "class"=>"table","style"=>"background-color:#84B365;border-radius: 15px; text-align:center;font-size:20px"
        ]);

        $pag = new CPager($opcPag, array());

        echo $pag->dibujate();
        echo "<br>";
        echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
        
        
        echo CHTML::dibujaEtiqueta("div",["class"=>"col-12"]),"",false;
        echo $tabla->dibujate();
        echo CHTML::dibujaEtiquetaCierre("div");
        echo CHTML::dibujaEtiquetaCierre("div");
        echo $pag->dibujate();
    } else {
        
        echo "<br>";
        echo CHTML::dibujaEtiqueta("div",["class"=>"nav nav-pills"],"",false);
        echo CHTML::dibujaEtiqueta("div",["class"=>"col-5"],"",false);
        echo CHTML::dibujaEtiquetaCierre("div");
        echo CHTML::dibujaEtiqueta("div",["class"=>"col-6"],"",false);
        echo CHTML::dibujaEtiqueta("div", [], "Añada primero un menu");
        echo CHTML::dibujaEtiquetaCierre("div");
    }
}