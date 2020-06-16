<?php


echo CHTML::iniciarForm();
echo "<br>";
echo CHTML::dibujaEtiqueta("div",["class"=>"nav nav-pills"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-4"],"",false);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiqueta("div",["class"=>"col-6"],"",false);
echo "Rellene los siguientes campo y pulse enviar para modificar los datos <br>";
echo CHTML::modeloHidden($perfil, "nick",["value"=>$id]);
echo CHTML::modeloHidden($perfil, "contrasena",["value"=>$id]);


echo CHTML::modeloLabel($perfil, "edad",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::modeloText($perfil, "edad");
echo CHTML::modeloError($perfil, "edad")."<br>";

echo CHTML::modeloLabel($perfil, "altura",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::modeloText($perfil, "altura");
echo CHTML::modeloError($perfil, "altura")."<br>";


echo CHTML::modeloLabel($perfil, "peso",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::modeloText($perfil, "peso");
echo CHTML::modeloError($perfil, "peso")."<br>";
echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-1"],"",true);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-7"],"",false);
echo CHTML::campoBotonSubmit("Modificar",["class"=>"col-11"]);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::finalizarForm();



echo CHTML::iniciarForm()."<br>";
echo "Rellene el siguiente campo con una nueva contraseña y envie si quieres modificarla <br>";
echo CHTML::modeloHidden($perfil, "nick",["value"=>$id,]);
echo CHTML::modeloLabel($perfil, "contrasena",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::modeloPassword($perfil, "contrasena");
echo CHTML::modeloError($perfil, "contrasena");
echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-1"],"",true);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-7"],"",false);
echo CHTML::campoBotonSubmit("Enviar",["name"=>"contra","class"=>"col-11"]);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");


echo CHTML::finalizarForm();

