var cate, marc, produInfo;
function obtenerFecha(){
    var d = new Date();
    var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
    return strDate;
}

$('.bdate1').click(function(){
    $('.dt1').datetimepicker({
        minDate: obtenerFecha()
    });
});

$('.bdate2').click(function(){
    $('.dt2').datetimepicker({
        minDate: obtenerFecha()
    });
});

$('.actualizar').click(function(){
    pro=$('.producto').val()
    FechaHoraInicio= $('.fh-i').val();
    FechaHoraFin=$('.fh-f').val();
    PrecioBase=$('.pb').val();
    console.log(FechaHoraFin);
    console.log(PrecioBase);
    $.ajax({
        type:"POST",
        url:  base_url + "Subasta/ActualizarSubasta",
        data: {Fhi:FechaHoraInicio, Fhf:FechaHoraFin, PrecioBase:PrecioBase, product:pro,id:$('.id').val() },
        dataType: 'text',
        success: function(data){
            if(data.localeCompare('La subasta se ha actualizado exitosamente')==0){
                color='success';
            }else{
                color='danger';
            }
            $('.msg').append($('<div>',{class:'mt-10 alert  alert-dismissable'+" "+'alert-'
            +color}).append
                (
                    $('<strong>',{text: data}),
                    $('<button>',{ class: 'close', text :'x', 'data-dismiss':'alert', 'arial-label': 'close'}), 
                )
            );  
        }, 
    });
})

$( ".categoria" ).on('click',function() {
    console.log('holi');
    cate=$(this).val();
    $('.product-op').remove();
    $('.marca-op').remove();
    $.ajax({
                    type:"GET",
                    url:  base_url + "Subasta/obtenerMarca",
                    data: {categoria:$(this).val()},
                    dataType: 'json',
                    success: function(data){
                            $.each(data, function(key, value){   
                                console.log(data[key].marca);     
                                if(data[key].marca != ' '){
                                    $('.marca').append
                                        (
                                                $('<option>',{text: data[key].marca, class:'marca-op'})   
                                        )      
                                }else{
                                    $('.marca.op').remove();
                                }
                            })
                    },
                    error: function(data){
                        console.log(data);
                    }
    });
});

$(".marca").on("click", function(){
    $('.product-op').remove();
    marc= $(this).val()
    $.ajax({
                    type:"GET",
                    url:  base_url + "Subasta/obtenerProductos",
                    data: {categoria:cate, marca:$(this).val() },
                    dataType: 'json',
                    success: function(data){
                             produInfo=data;
                            $.each(data, function(key, value){        
                                if(data[key].nombre !=' '){
                                    $('.producto').append
                                        (
                                            
                                                $('<option>',{text: data[key].nombre, class: 'product-op'})                                           
                                        )     
                                }else{
                                    $(".product-op").remove();
                                }
                            })
                    },
                    error: function(data){
                        console.log(data);
                    }
    });
    
});
