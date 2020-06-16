var $name = "";
var $cookie= "";
if($("#cookie")){
	$cookie =$("#cookie");
	$dato = $("#cookie");
	if($cookie.attr("name")!=undefined){
	$name =" " +$cookie.attr("name");

	document.cookie=$name+"="+$dato.val();
}
}


if($("#cookie").attr("name")){
	$name=$("#cookie").attr("name");
	$name1=" " +$("#cookie").attr("name");
	let contador = 0;
	let cookiee=document.cookie.split("=");
	for(let i in cookiee){
		let nombre=cookiee[i].split(";");
		if(nombre[1]==$name1){
			contador= i;
			console.log($name+" "+nombre)
		}else if(nombre[0]==$name){
		contador= i;
		}
	}
	let nombre=cookiee[contador].split(";")
	if(nombre[1]==$name1 ){
		contador++;
		let split = cookiee[contador].split(";");
		$mensaje=$("<div><p>Conectado "+split[0]+" veces.<p></div>")
		if($("#mensaje")){
			$("#mensaje").append($mensaje);
		}

	}
	else if(nombre[0]==$name){
		contador++;
	let split = cookiee[contador].split(";");
		$mensaje=$("<div><p>Conectado "+split[0]+" veces.<p></div>")
		if($("#mensaje")){
			$("#mensaje").append($mensaje);
		}
	}
		
}