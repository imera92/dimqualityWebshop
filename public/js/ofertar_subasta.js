$('.ofertar').click(function(){
    subasta_id = $('#auc-id').val();
    oferta_monto = $('#bid-val').val();
    $.ajax({
        type:'POST',
        url:  base_url + 'subasta/guardar_oferta',
        data: {
            'subasta_id': subasta_id,
            'oferta_monto': oferta_monto
        },
        dataType: 'json',
        success: function(data) {
            if(data[0].success == 1) {
                $.trim(data['url']);
                window.location.href = base_url + data[0].url;
            } else {
                if ($('#no-data-alert').length > 0) {
                    $('#no-data-alert').remove();
                }
                $('#info-box .infodelproducto').append($('<div id="no-data-alert" class="row mt-20"><div class="col-xs-12"><div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">' + '&times;' + '</span></button>' + data[0].msg + '</div></div></div>'));
            }
        }
    });
});

$("#bid-val").keypress(function(tecla) {
    if( tecla.charCode < 48 || tecla.charCode > 57){
        return false;
    }
}); 

