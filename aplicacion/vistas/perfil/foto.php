<?php
echo "<br>";
echo CHTML::iniciarForm("","post",["enctype"=>"multipart/form-data"]);
echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-3"]);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::campoLabel("Foto,formato .jpg :", "foto");
echo CHTML::campoFile("Foto");
echo CHTML::campoBotonSubmit("Subir foto");
echo CHTML::finalizarForm();
