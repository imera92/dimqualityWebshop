
$('#botonBusqueda').on('click', function(){
	terminoBusqueda = $('#terminoBusqueda').val();
	if (terminoBusqueda != '') {
		solicitarBusquedaProducto(terminoBusqueda);		
	} else {
		alert('Debe escribir una palabra para realizar la búsqueda.');
	}
});

function solicitarBusquedaProducto(terminoBusqueda){
	$('#formBusqueda').submit();
}

$(function() {
    $('.equalHeightBox').matchHeight();
});