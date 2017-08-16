
Contrasena_V=$('.vc').val();
$('.vc').keypress(function(){
    Contrasena= $('.c').val();
    Contrasena_V= $('vc').val();    
    if(Contrasena != Contrasena_V){ 
        console.log("deed");
        $('.vc').css("background-color","rgba(215, 40, 44, 0.4)");
    }if(Contrasena == Contrasena_V){
        $('.vc').css("background-color","white");
    }
 });