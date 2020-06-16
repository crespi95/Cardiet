<?php
echo CHTML::dibujaEtiqueta("div",["class"=>"row"],"",false);
echo CHTML::dibujaEtiqueta("div",["class"=>"col-4"],"",false);
echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::dibujaEtiqueta("div",["clas"=>"col-6"],"",false);

echo CHTML::dibujaEtiqueta("p",[],"",false);

echo CHTML::iniciarForm();
echo CHTML::modeloHidden($modelo, "cod_hilo",["value"=>$hilo]);
echo CHTML::dibujaEtiqueta("table",["class"=>"table","style"=>"background-color:#84B365;border-radius: 15px;"],"",false);
echo CHTML::dibujaEtiqueta("tr",[],"",false);
echo CHTML::dibujaEtiqueta("td",[],"",false);
echo CHTML::modeloLabel($modelo, "titulo",["style"=>"font-size:26px"]);
echo CHTML::dibujaEtiquetaCierre("td");
echo CHTML::dibujaEtiqueta("td",[],"",false);
echo CHTML::modeloText($modelo, "titulo",["style"=>"font-size:26px","size"=>30])."<br><br>";
echo CHTML::campoBotonSubmit("Crear",["style"=>"width:25em;height:2em"]);
echo CHTML::dibujaEtiquetaCierre("td");

echo CHTML::dibujaEtiquetaCierre("tr");
echo CHTML::dibujaEtiquetaCierre("table");

echo CHTML::finalizarForm();

echo CHTML::dibujaEtiquetaCierre("p");
echo CHTML::dibujaEtiquetaCierre("div");
echo CHTML::dibujaEtiquetaCierre("div");
