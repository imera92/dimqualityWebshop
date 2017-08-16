$('.Busqueda').on('click', function(){ 
    if ($('.email').val() != '') {
            if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test($('.email').val())){
                $.ajax({
                    type:"POST",
                    url:"verificarCorreo",
                    data: {email:$('.email').val()},
                    dataType: 'text',
                    success: function(data){
                        if(data=="este correo no registra ninguna cuenta" || data =="ingrese un correo electronico"){
                            color='alert-danger';
                        }else{
                            color='alert-success';
                        }
                        $('.well').append($('<div>',{class:' alert  alert-dismissable'+" "+color}).append
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
            }else{
                $('.well').append($('<div>',{class:' alert alert-danger  alert-dismissable'}).append
                (
                    $('<strong>',{text: 'la direccion de email no es valida'}),
                    $('<button>',{ class: 'close', text :'x', 'data-dismiss':'alert', 'arial-label': 'close'}), 
                )
            );       
            }   
    } else {        
            $('.well').append($('<div>',{class:' alert alert-danger  alert-dismissable agregado'}).append
                (
                    $('<strong>',{text: 'El email es un campo requerido para recuperar su cuenta'}),
                    $('<button>',{ class: 'close', text :'x', 'data-dismiss':'alert', 'arial-label': 'close'}), 
                )
            );
             
    }
});