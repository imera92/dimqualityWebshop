$('.btn-danger').on('click', function(e){
    var txt;
    if (confirm("¿Esta seguro que quiere eliminar este registro?") == true) {
        txt = "Ud presionó eliminar!";
        e.preventDefault();
        var subastaId = $(this).attr('name');
    	//console.log(subastaId);
        /*
    	$.ajax({
    		url: js_base_url('subasta/eliminar/')+subastaId,
    		type:"POST",
    		data:{
    			'subastaId': subastaId
    		},
            success:function(response) {
    			location.reload();
    		},
    		error:function(){
    			alert("Error al eliminar producto.");
    		}
        });
        */
        location.href = js_base_url('subasta/eliminar/')+subastaId;
    }
    console.log(txt);
});

$('.btn-modal-trigger').on('click', function(e){
    $.ajax({
        type:"POST",
        url:  base_url + "subasta/read_subasta_data",
        data: {
            'subasta_id' : $(this).attr('data-subasta-id')
        },
        dataType: 'json',
        success: function(data){
                $('#read_subasta_modal_label').html(data.nombre_producto);
                $('#read_subasta_modal_fecha_inicio').html(data.fecha_inicio);
                $('#read_subasta_modal_fecha_fin').html(data.fecha_fin);
                $('#read_subasta_modal_oferta_mayor').html(data.oferta_mayor);
                $('#read_subasta_modal_ganador').html(data.ganador);
                $('#read_subasta_modal_ofertas_label').hide();
                $('#read_subasta_modal_table').hide();
                $('#read_subasta_modal_ofertas tbody').empty();
                if (data.ofertas.length != 0) {
                    for (var i = 0, len = data.ofertas.length; i < len; i++) {
                        $('#read_subasta_modal_ofertas tbody').append('<tr><td class="text-center">' + data.ofertas[i].fecha + '</td><td class="text-center">' + data.ofertas[i].hora + '</td><td class="text-center">' + data.ofertas[i].monto + '</td><td class="text-center">' + data.ofertas[i].usuario_nombre + '</td><td class="text-center">' + data.ofertas[i].usuario_cedula + '</td></tr>');
                    }
                    $('#read_subasta_modal_table').show();
                } else {
                    $('#read_subasta_modal_table').hide();
                    $('#read_subasta_modal_ofertas_label').show();
                }
        },
        error: function(data){
            console.log(data);
        }
    });
});

