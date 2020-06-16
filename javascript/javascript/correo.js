
$( "#sugerencia" ).blur(function() {
	if($("#sugerencia").val()=="" ){
  $("#sugerencia").css("border-color","red");
  $( "#enviar" ).hide(800);
	}
});

$( "#email" ).blur(function() {
	if(!$("#email").val().match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/) 
				|| $("#email").val()=="" ){
  $("#email").css("border-color","red");
  alert("Introduce una dirección de correo válida");
  $( "#enviar" ).hide(800);
	}
});

$( "#email" ).blur(function() {
	if($("#email").val()!=""
		&& $("#email").val().match(/([a-z][a-z0-9-_]*)@([a-z][a-z0-9-]+\.[a-z]{2,3})$/)){
	
  $("#email").css("border-color","#999");

	}
});

$( "#sugerencia" ).blur(function() {
	if($("#sugerencia").val()!=""){
	
  $("#sugerencia").css("border-color","#999");

	}
});

$( "#email" ).blur(function() {
	if($("#email").val().match(/([a-z][a-z0-9-_]*)@([a-z][a-z0-9-]+\.[a-z]{2,3})$/)
		&& $("#sugerencia").val()!=""){
  $( "#enviar" ).show(800);
	}
});

$("#sugerencia").blur(function() {
	if($("#email").val().match(/([a-z][a-z0-9-_]*)@([a-z][a-z0-9-]+\.[a-z]{2,3})$/)
		&& $("#sugerencia").val()!=""){
  $( "#enviar" ).show(800);
	}
});

$("#enviar").hover(function(){
	$("#enviar").css("background-color","green");
	$("#enviar").css("color", "black;");

})





