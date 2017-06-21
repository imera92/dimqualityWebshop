$(document).ready(function() {
	$("input[type=radio]").change(function() {		
		if($("#radioDom").prop("checked")){
			$("#sameAddress").show();
		}else
		{
			$("#sameAddress").hide();
			$("#sameCheck").prop("checked",true);
			$("#sameCheck").change();
		}
	});
	$("#sameCheck").change(function() {
		if($("#sameCheck").prop("checked")){
			$("#deliveryAddress").hide();
			$("[name=nombreEntrega]").val($("[name=nombre]").val());
			$("[name=direccionEntrega]").val($("[name=direccion]").val());
		}
		else{
			$("#deliveryAddress").show();			
		}
	})
	$("[name=nombre]").change(function function_name(argument) {
		if($("#sameCheck").prop("checked")){
			$("[name=nombreEntrega]").val($("[name=nombre]").val());
		}
	});
	$("[name=direccion]").change(function function_name(argument) {
		if($("#sameCheck").prop("checked")){
			$("[name=direccionEntrega]").val($("[name=direccion]").val());
		}
	});
});

function showShippingAddress(argument) {
	
}