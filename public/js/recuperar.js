$('.Busqueda').on('click', function(){ 
    if ($('.email').val() != '') {
            if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test($('.email').val())){ // hacer tambien en el backend
                $.ajax({
                    type:"POST",
                    url:  base_url + "/web/verificarCorreo",
                    data: {email:$('.email').val()},
                    dataType: 'text',
                    success: function(data){
                        if(data=="La dirección de correo proporcionada no está vinculada a ninguna cuenta de usuario" || data =="ingrese un correo electronico"){
                            color='alert-danger';
                        }else{
                            color='alert-success';
                        }
                        $('.msg').append($('<div>',{class:'  alert  alert-dismissable'+" "+color}).append
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
                $('.msg').append($('<div>',{class:' alert   alert-danger  alert-dismissable'}).append
                (
                    $('<strong>',{text: 'Es necesario que ingrese un dirección de correo para recuperar su contraseña'}),
                    $('<button>',{ class: 'close', text :'x', 'data-dismiss':'alert', 'arial-label': 'close'}), 
                )
            );       
            }   
    } else {        
            $('.msg').append($('<div>',{class:'alert alert-danger  alert-dismissable agregado'}).append                              
                (
                    $('<strong>',{text: 'Es necesario que ingrese una dirección de correo para recuperar su contraseña'}),
                    $('<button>',{ class: 'close', text :'x', 'data-dismiss':'alert', 'arial-label': 'close'}), 
                )
            );
             
    }
});

