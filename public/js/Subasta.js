var cate, marc, produInfo,id;
function obtenerFecha(){
    var d = new Date();
    var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
    return strDate;
}


 $('.datetimepicker1').datetimepicker({
    minDate: obtenerFecha()
});

$( ".categoria" ).click(function() {
    cate=$(this).text();
    $('.marca-list').remove();
    $.ajax({
                    type:"GET",
                    url:  base_url + "Subasta/obtenerMarca",
                    data: {categoria:$(this).text()},
                    dataType: 'json',
                    success: function(data){
                            $('.marca').append($('<ul>',{class:'dropdown-menu marcalist'}));
                           
                            $.each(data, function(key, value){        
                                if(data[key].marca != ' '){
                                    $('.marca > ul').append
                                        (
                                            $('<li>').append
                                            (
                                                $('<a>',{text: data[key].marca, href:'#', class:'marca-list'})
                                            )
                                        )      
                                }else{
                                    $('.marcalist').remove();   
                                }
                            })
                    },
                    error: function(data){
                        console.log(data);
                    }
    });
});

$(".marca").on("click", ".marca-list", function(){
    $(".productolist").remove();
    marc= $(this).text();
    $.ajax({
                    type:"GET",
                    url:  base_url + "Subasta/obtenerProductos",
                    data: {categoria:cate, marca:$(this).text() },
                    dataType: 'json',
                    success: function(data){
                            $('.producto').append($('<ul>',{class:'dropdown-menu productolist'}));
                             produInfo=data;
                            $.each(data, function(key, value){        
                                if(data[key].nombre !=' '){
                                    $('.producto > ul').append
                                        (
                                            $('<li>').append
                                            (
                                                $('<a>',{text: data[key].nombre, href:'#', class: 'product-list'})
                                            )
                                        )     
                                }else{
                                    $(".productolist").remove();
                                }
                            })
                    },
                    error: function(data){
                        console.log(data);
                    }
    });
    
});

$(".producto").on("click", ".productolist", function(){
        
        producto=$(this).text();
        $.each(produInfo, function(key, value){  
            if(produInfo[key].nombre==producto){
                id=produInfo[key].id;
            }
        });  
});

$( ".obtener" ).click(function() {
    FechaHoraInicio= $('.fh-i').val();
    FechaHoraFin=$('.fh-f').val();
    PrecioBase=$('.pb').val();
    $.ajax({
                    type:"POST",
                    url:  base_url + "Subasta/Guardar",
                    data: {Fhi:FechaHoraInicio, Fhf:FechaHoraFin, PreBa:PrecioBase, categoria:cate, product:id },
                    dataType: 'text',
                    success: function(data){
                
                            if(data.localeCompare('La subasta se ha creado exitosamente')){
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