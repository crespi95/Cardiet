<?php 
    echo "<br>";
    echo CHTML::iniciarForm();
    echo CHTML::dibujaEtiqueta("div",["class"=>"nav nav-pills"],"",false); 
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-4"],"",false);
    echo CHTML::dibujaEtiquetaCierre("div");
    echo CHTML::dibujaEtiqueta("div",["class"=>"col-6"],"",false);
    echo CHTML::modeloLabel($log, "nick",["class"=>"col-4 col-md-4 col-sm-5"]).
         CHTML::modeloText($log, "nick",["placeholder"=>"nick","size"=>10]).
         CHTML::modeloError($log, "nick").
         "<br>".PHP_EOL;
         echo CHTML::modeloLabel($log, "contrasena",["class"=>"col-4 col-md-4 col-sm-5"]).
    CHTML::modeloPassword($log, "contrasena",["placeholder"=>"contraseña","size"=>10]).
         CHTML::modeloError($log, "contrasena").
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