$(document).ready(function(){
    $('.botonBusqueda').on('click', function(){
        terminoBusqueda = $('.email').val();
        if (terminoBusqueda != '') {
            console.log('entre');
            EnviarEmail(terminoBusqueda);		
        } else {
            alert('Debe escribir una palabra para realizar la búsqueda.');
        }
    });
});

function EnviarEmail(terminoBusqueda){
	$('#formRecuperar').submit();
}