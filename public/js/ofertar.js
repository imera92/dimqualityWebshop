$('.ofertar').click(function(){
    id=$('.si').val();
    valor= $('.valor').val();
    $.ajax({
        type:"Post",
        url:  base_url + "Subasta/guardarOferta",
        data: {valor:valor, id: id},
        dataType: 'text',
        success: function(data){
            if(data.trim()!="error1" &&  data.trim()!="error2"){
                $.trim(data);
                window.location.href = base_url+ data;  
            }else if(data.trim()=="error1"){
                color="danger";
                $('.msg').append($('<div>',{class:'mt-10 alert  alert-dismissable'+" "+'alert-'
                +color}).append
                    (
                        $('<strong>',{text: "Ha ocurrido un error. El valor de la oferta no puede ser 0"}),
                        $('<button>',{ class: 'close', text :'x', 'data-dismiss':'alert', 'arial-label': 'close'}), 
                    )
                );  
            }else{
                $('.infodelproducto').append($('<strong class="req">ingrese un valor</strong>'));
                console.log("here");
            }
        }
});
    
});

$(".valor").keypress(function(tecla){
    if( tecla.charCode < 48 || tecla.charCode > 57){
      return false;
    }
}); 

