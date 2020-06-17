<?php

$datos = $_POST["datos"];
$alimento = explode("_", $datos[0]);
$datos = implode("-", $alimento);
$url ="api.myfitnesspal.com/public/nutrition?q=".$datos;
$headers = array(
    'Accept: application/json',
    'Content-Type: application/json',
    
); 

$enlaceCurl = curl_init();
curl_setopt($enlaceCurl, CURLOPT_URL, $url);
curl_setopt($enlaceCurl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($enlaceCurl, CURLOPT_FOLLOWLOCATION, true);
//curl_setopt($enlaceCurl, CURLOPT_PROXY, "192.168.2.254:3128");

$objeto = curl_exec($enlaceCurl);
curl_close($enlaceCurl);



//$objeto = json_encode($objeto);


echo $objeto;