$(document).ready(function() {

    $('.btn-modal-trigger').on('click', function(e){
        $.ajax({
            type:"POST",
            url:  base_url + "cita/leer_solicitud_por_id",
            data: {
                'solicitud_id' : $(this).attr('data-solicitud-id')
            },
            dataType: 'json',
            success: function(data){
                    $('#modal_idSolicitud').html(data.id);
                    $('#modal_usuario').html(data.usuario);
                    $('#modal_cedula').html(data.cedula);
                    $('#modal_correo').html(data.correo);
                    $('#modal_fechaSolic').html(data.fecha_creac);
                    $('#modal_fechaCita').html(data.fecha_cita);
                    $('#modal_ubicacion').html(data.ubicacion);
                    $('#modal_estado').html(data.estado);
            },
            error: function(data){
                console.log(data);
            }
        });
    });

    $('#btnguardar').on('click', function(e){
        console.log(e);
    });
});
