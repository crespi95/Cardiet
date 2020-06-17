<?php


echo CHTML::iniciarForm();
echo "<br>";
echo CHTML::dibujaEtiqueta("div",["class"=>"nav nav-pills"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-4"],"",false);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiqueta("div",["class"=>"col-6"],"",false);
echo CHTML::modeloHidden($usu, "cod_usuario",["value"=>$id,]);

echo CHTML::modeloLabel($usu, "nick",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::modeloText($usu, "nick",["disabled"=>"disabled",]);
echo CHTML::modeloError($usu, "nick")."<br>";

echo CHTML::modeloLabel($usu, "cod_rol",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::modeloListaDropDown($usu, "cod_rol",$roles);
echo CHTML::modeloError($usu, "cod_rol")."<br>";


echo CHTML::modeloLabel($usu, "borrado",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::modeloNumber($usu, "borrado",["min"=>0,"max"=>1]);
echo CHTML::modeloError($usu, "borrado")."<br>";
echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-1"],"",true);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-7"],"",false);
echo CHTML::campoBotonSubmit("Modificar",["class"=>"col-11"]);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::finalizarForm();
