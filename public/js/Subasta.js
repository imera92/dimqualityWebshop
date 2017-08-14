var cate, marc, produInfo;
function obtenerFecha(){
    var d = new Date();
    var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
    return strDate;
}


 $('.datetimepicker1').datetimepicker({
    minDate: obtenerFecha()
});

$( ".categoria" ).on('change',function() {
    cate=$(this).val();
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

$(".marca").on("change", function(){
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






$( ".obtener" ).click(function() {
    FechaHoraInicio= $('.fh-i').val();
    FechaHoraFin=$('.fh-f').val();
    PrecioBase=$('.pb').val();
    $.each(produInfo, function(key, value){
        producto=produInfo[key].nombre;
        producto_selec=$('.producto').val();
        console.log(producto);
        console.log(producto_selec);
        if(producto.localeCompare(producto_selec)==0){
            id_pro=produInfo[key].id;
            console.log(id_pro);
            return id_pro;
        }
    });
    $.ajax({
                    type:"POST",
                    url:  base_url + "Subasta/Guardar",
                    data: {Fhi:FechaHoraInicio, Fhf:FechaHoraFin, PrecioBase:PrecioBase, product:id_pro },
                    dataType: 'text',
                    success: function(data){
                            if(data.localeCompare('La subasta se ha creado exitosamente')==0){
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
                    error: function(data){
                        console.log(data);
                    }
    });

});

$('.cancelar').click(function(){
    location.reload();
})