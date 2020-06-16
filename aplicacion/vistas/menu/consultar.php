<?php

echo "<br>";
echo CHTML::dibujaEtiqueta("div",["class"=>"nav nav-pills"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-4"],"",false);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiqueta("div",["class"=>"col-6"],"",false);

echo CHTML::dibujaEtiqueta("div",[],"El día <b>".$fila["fecha"]."</b> se tomo el siguiente menu: <br> ".$comida."<br><br>");
 
echo CHTML::dibujaEtiqueta("div",["class"=>"col-7"],"-Se aportó un total de <b>".$fila["kcal"]." kcal</b>. $gasto");
echo CHTML::dibujaEtiquetaCierre("div");