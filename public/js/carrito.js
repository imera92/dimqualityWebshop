$('a[class~="btn-remove"]').on('click', function(e){
	e.preventDefault();
	// console.log();
	$.ajax({
		url: js_base_url('carrito/eliminarProducto'),
		type:"POST",
		data:{
			'productoId': $(this).find('input[name="productoId"]').val()
		},
		success:function(response) {
			location.reload();
		},
		error:function(){
			alert("Error al eliminar producto.");
		}
	});
});
$('button[class~="btn-actualizar"]').on('click', function(e){
	productoId = $(this).attr('data-productoId');
	$.ajax({
		url: js_base_url('carrito/anadirProducto'),
		type:"POST",
		data:{
			'id': $('#id' + productoId).val(),
			'cantidad' : $('#cantidad' + productoId).val()
		},
		success:function(response) {
			location.reload();
		},
		error:function(){
			alert("Error al actualizar producto.");
		}
	});
});
$(document).ready(function() {
	$("input[type='number']").stepper();
});