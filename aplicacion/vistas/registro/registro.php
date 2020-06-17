<?php

echo "<br>";
echo CHTML::iniciarForm();
echo CHTML::dibujaEtiqueta("div",["class"=>"nav nav-pills"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-4"],"",false);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiqueta("div",["class"=>"col-6"],"",false);
echo CHTML::modeloLabel($reg, "nick",["class"=>"col-4 col-md-4 col-sm-5"]).
CHTML::modeloText($reg, "nick",["placeholder"=>"nick","size"=>10]).
CHTML::modeloError($reg, "nick").
"<br>".PHP_EOL;
echo CHTML::modeloLabel($reg, "contrasena",["class"=>"col-4 col-md-4 col-sm-5"]).
CHTML::modeloPassword($reg, "contrasena",["placeholder"=>"contraseña","size"=>10]).
CHTML::modeloError($reg, "contrasena").
"<br>".PHP_EOL;
echo CHTML::modeloLabel($reg, "edad",["class"=>"col-4 col-md-4 col-sm-5"]).
CHTML::modeloText($reg, "edad",["placeholder"=>"edad","size"=>10]).
CHTML::modeloError($reg, "edad").
"<br>".PHP_EOL;
echo CHTML::modeloLabel($reg, "altura",["class"=>"col-4 col-md-4 col-sm-5"]).
CHTML::modeloNumber($reg, "altura",["placeholder"=>"altura"]).
CHTML::modeloError($reg, "altura").
"<br>".PHP_EOL;
echo CHTML::modeloLabel($reg, "peso",["class"=>"col-4 col-md-4 col-sm-5"]).
CHTML::modeloNumber($reg, "peso",["placeholder"=>"peso", "step"=>"0.5"]).
CHTML::modeloError($reg, "peso").
"<br>".PHP_EOL;
echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-7"],"",false);
echo CHTML::campoBotonSubmit("validar",["class"=>"col-11"]).
"<br>".PHP_EOL;
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::finalizarForm();