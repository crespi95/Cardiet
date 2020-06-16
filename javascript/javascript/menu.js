var url = "/consultas/dameAlimentos.php";
$("#id_0").click(function (){
	let alimento = $("#txtAli").val();
	alimento = alimento.split(" ");
	alimento = alimento.join("_");


	if(!alimento){
		alert("Inserta un alimento");
	}else{
		var $select=$("#select");
		$.post( url,{datos:alimento}
		).done(function(data){
			let datos = JSON.parse(data);
			$select.empty();
			$select.append($(new Option("Seleccionar alimento")));
			for(let i of datos.items){
				let nombre = i.item.brand_name;
				let kcal = i.item.nutritional_contents.energy.value;

				$select.append($(new Option(nombre+"("+kcal+"kcal)",kcal)));		

			}	
		})
	}
});



$("#id_1").click(function() {
	var $cajaAli=$("#cajaAli");

	let $alimento = $("#select :selected").html();
	let $kcal = parseInt($("#select :selected").val());
	let $cantidad = parseInt($("#cantidad").val());
	let $kcaltotal = ($kcal*$cantidad)/100;

	$alimento2 = $alimento.split("(")[0];

	if(!$cantidad){
		alert("Añade una cantidad");
	}else if($alimento=="Seleccione una opcion"){
		alert("Inserta un alimento primero");
	}else if($alimento=="Seleccionar alimento"){
		alert("Selecciona un alimento");
	}else{

		console.log($kcaltotal);
		$label=$("<label value='"+$kcaltotal+"' name='menu'> -"+$alimento+"("+$cantidad+"g), aporta "+$kcaltotal+"kcal </label>" )
		$boton=$("<input type='button'>");
		$boton.width("28px");
		$boton.height("28px");
		$boton.css("background-image","url('/imagenes/24x24/borrar.png')");
		$boton.click(function(){
			$(this).parent().remove();
		});
		$div=$("<div></div>");
		$div.append($label);
		$div.append($boton);
		$cajaAli.append($div);
		$("#txtAli").val("");
		$("#cantidad").val("");

	}});
$("#id_2").click(function(){
	$txtA=$("#menu_menu");
	$menu=$("[name=menu]");
	$kcal = $("#menu_kcal");

	let text="";
	let value=0;
	$menu.each(function(i, el) { 
		text+=$(el).html()+"\n\r";
		value+=parseInt( $(el).attr("value"));

	});

	$txtA.text(text);
	$kcal.val(value);
	$("#cajaAli").empty();


});
$("#ayuda").hide();
$("#id_3").click(function(){
	//$texto=$("<p>'Añada una palabra descriptiva del alimento o su nombre,a continuación pulse en consultar.<br>Seleccione un alimento de la lista, especifique las cantidades en gramos y pulse añadir.<br> Añada todos los alimentos que desee y pulse confirmar, podrá borrarlos en la 'X' que aparecerá.'</p>");
	//$("#ayuda").append($texto);
	$("#ayuda").toggle();


})

