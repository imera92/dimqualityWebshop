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



$('.subastaForm').validate({
    debug: false,
    rules: {
        fhi: { 
          required: true

        } , 

            fhf: { 
             required:true
            
        },
            preb:{
                required:true
        },
        myselect: { required: true }
    },
messages:{
        fhi: 'Ingrese una fecha de inicio',
        fhf:'Ingrese una fecha de fin',
        preb:'Ingrese un precio base',
        myselect: "Debe seleccionar un producto"
        }, errorElement : 'strong',
        errorPlacement: function(error,element){
            switch(element.attr("name")){
                case 'fhi':
                    error.insertAfter($('#box1'));
                    break;
                
                case 'fhf':
                    error.insertAfter($('.dt2'));
                    break;
                
                case 'preb':
                    error.insertAfter($('.pb'));
                    break;
                case 'myselect':
                    error.insertAfter($('.box3'));
                    break;
                default:
                  //nothing
            }
        }
    

});

//no permite que escriba campos alfanumericos en el precio base
$(".pb").keypress(function(tecla){
    if( tecla.charCode < 48 || tecla.charCode > 57){
      return false;
    }
}); 

$( ".categoria" ).on('click',function() {
    if(cate != $(this).val()){
        $('.product-op').remove();
        cate=$(this).val();
        $('.marca-op').remove();
        $.ajax({
                        type:"GET",
                        url:  base_url + "Subasta/obtenerMarca",
                        data: {categoria:$(this).val()},
                        dataType: 'json',
                        success: function(data){
                                console.log(data);
                                $.each(data, function(key, value){
                                    // console.log(data[key]['nombre']);
                                    if(data[key]['id'] != ''){
                                        $('.marca').append
                                            (
                                                $('<option>', {text: data[key]['nombre'], class:'marca-op', value: data[key]['id']})
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
    }
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
$('.cancelar').click(function(){
    window.location.replace(base_url + 'subasta/subastas');
})
$(document).ready(function() {
    $('form').submit(function(){
        pro=$('.producto').val()
        FechaHoraInicio= $('.fh-i').val();
        FechaHoraFin=$('.fh-f').val();
        PrecioBase=$('.pb').val();
        console.log(FechaHoraFin);
        console.log(PrecioBase);
        $.ajax({
            type:$('.subastaForm').attr('method'),
            url:  $('.subastaForm').attr('action'),
            data: {Fhi:FechaHoraInicio, Fhf:FechaHoraFin, PrecioBase:PrecioBase, product:pro,id:$('.id').val() },
            dataType: 'text',
            success: function(data){
                console.log(data);
                if((data).trim() != "subasta/crear/2"){
                    color='danger';
                    $('.msg').append($('<div>',{class:'mt-10 alert  alert-dismissable'+" "+'alert-'
                    +color}).append
                        (
                            $('<strong>',{text: data}),
                            $('<button>',{ class: 'close', text :'x', 'data-dismiss':'alert', 'arial-label': 'close'}), 
                        )
                    );  
                    
                }else{    
                    window.location.href = base_url+ data;
                }
            }, 
        });
    event.preventDefault();
    })
});