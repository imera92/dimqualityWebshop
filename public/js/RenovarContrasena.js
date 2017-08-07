$("#formCheckPassword").validate({
           rules: {
               contrasena: { 
                 required: true,
                    minlength: 6,
                    maxlength: 10,

               } , 

                   vContraseña: { 
                    required:true,
                    equalTo: ".c",
                    minlength: 6,
                    maxlength: 10
               }
           },
     messages:{
         contrasena: { 
                 required:"Password Requerido",
                 minlength: "Minimo 6 caracteres",
                 maxlength: "Maximo 10 caracteres"
               },
       vContraseña: { 
         equalTo: "El password debe ser igual al anterior",
         minlength: "Minimo 6 caracteres",
         maxlength: "Maximo 10 caracteres"
       }
     }

});

$('.Busqueda').on('click', function(){ 
    console.log("click")
    $.ajax({
                    type:"POST",
                    url:  base_url + "/web/ActualizarContrasena",
                    data: {contrasena:$('.c').val(), vContraseña:$('.vc').val(), t:$('.t').val(), us:$('.us').val()},
                    dataType: 'text',
                    success: function(data){
                            color='alert-danger';
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
});