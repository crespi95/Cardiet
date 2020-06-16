<?php
echo "<br>";
echo CHTML::iniciarForm();
echo CHTML::dibujaEtiqueta("div",["class"=>"nav nav-pills"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-3"],"",false);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiqueta("div",["class"=>"col-6"],"",false);
echo CHTML::dibujaEtiqueta("p",["style"=>"text-align:center"],"Esta página web, esta realizada para que puedas mantener un seguimiento de tu gasto calórico. <br>
    Para ello podrás añadir a tu menú una larga lista de alimentos. <br>
    Además, podrás ponerte en contacto con profesionales de la dietética, que podrán asesorarte para conseguir tus objetivos respecto del ambito de la alimentación.");

echo CHTML::imagen("/imagenes/alimentacion.jpg","alimentos",["class"=>"col-12"]);
echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiqueta("div",["class"=>"col-3"],"",false);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::finalizarForm();