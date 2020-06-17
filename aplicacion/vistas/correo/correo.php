<?php
$this->textoHead ="<script src='/javascript/correo.js' defer></script>";
$this->textoHead .="<script src='/javascript/cookie.js' defer></script>";
echo "<br>";
echo CHTML::iniciarForm();
echo CHTML::dibujaEtiqueta("div",["class"=>"nav nav-pills"],"",false); 
echo CHTML::dibujaEtiqueta("div",["class"=>"col-4"],"",false);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiqueta("div",["class"=>"col-6"],"",false);
echo CHTML::campoLabel("Email: ", "email",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::campoText("Email","",["id"=>"email","placeholder"=>"email"])."<br>";

echo CHTML::campoLabel("Sugerencia: ", "sugerencia",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::campoTextArea("Sugerencia","",["id"=>"sugerencia","placeholder"=>"sugerencia","cols"=>24])."<br>";

echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-1"],"",true);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-7","id"=>"mensaje"],"",false);
echo CHTML::campoBotonSubmit("Enviar",["id"=>"enviar","class"=>"col-11"]);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::finalizarForm();