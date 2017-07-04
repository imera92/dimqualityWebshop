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