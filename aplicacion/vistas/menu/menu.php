<?php
$this->textoHead ="<script src='/javascript/menu.js' defer></script>";
echo "<br>";

echo CHTML::dibujaEtiqueta("div",["class"=>"nav nav-pills"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-3"],"",false);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiqueta("div",["class"=>"col-6"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-2"],"",true);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-7"],"",false);
echo CHTML::boton("Ayuda",["id"=>"id_3","class"=>"col-11"])."<br><br>";
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiqueta("p",["id"=>"ayuda","style"=>"text-align:center"],"Añada un alimento,
                             a continuación pulse en consultar.<br>
                            Seleccione un alimento de la lista, especifique las cantidades en gramos y pulse añadir.<br>
                            Añada todos los alimentos que desee, podrá borrarlos en la 'X' que aparecerá. Por último, pulse confirmar, elija una fecha y envie.");

echo CHTML::campoLabel("Alimento: ", "txtAli",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::campoText("txtAli","")." ";
echo CHTML::boton("Consultar",["id"=>"id_0"])."<br>";

echo CHTML::campoLabel("Selecciona: ", "select",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::campoListaDropDown("select", [], [],["id"=>"select"])."<br>";
echo CHTML::campoLabel("Cantidad(g): ", "cantidad",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::campoText("cantidad", "",["placeholder"=>"Cantidad"])." ";
echo CHTML::boton("Añadir",["id"=>"id_1"]);
echo CHTML::dibujaEtiqueta("div",["id"=>"cajaAli"]).CHTML::dibujaEtiquetaCierre("div")."<br>";
echo CHTML::campoLabel("Añada los alimentos que has consumido en un día y despues confirme", "")."<br><br>";

echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-1"],"",true);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-7"],"",false);
echo CHTML::boton("Confirmar",["id"=>"id_2","class"=>"col-11"])."<br><br>";
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::iniciarForm();
echo CHTML::modeloHidden($menu, "usuario");
echo CHTML::modeloError($menu, "usuario");
echo CHTML::modeloLabel($menu, "menu",["class"=>"col-4 col-md-4 col-sm-5"])."<br>";
echo CHTML::modeloTextArea($menu, "menu",["placeholder"=>"Menu","cols"=>80,"rows"=>6]);
echo CHTML::modeloError($menu, "menu")."<br>";

echo CHTML::modeloLabel($menu, "kcal",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::modeloText($menu, "kcal",["placeholder"=>"Kcal totales"]);
echo CHTML::modeloError($menu, "kcal")."<br>";

echo CHTML::modeloLabel($menu, "fecha",["class"=>"col-4 col-md-4 col-sm-5"]);
echo CHTML::modeloDate($menu, "fecha");
echo CHTML::modeloError($menu, "fecha");
echo "<br>";

echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-1"],"",true);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-7"],"",false);
echo CHTML::campoBotonSubmit("Enviar",["class"=>"col-11"])."<br><br>";
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiqueta("div",["class"=>"col-3"],"",false);
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::finalizarForm();