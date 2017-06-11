$(document).ready(function(){
   $('#cancel-button').addClass("btn-danger");
   $('#form-button-save').addClass("btn-success");
   $('#save-and-go-back-button').addClass("btn-info");
   $('.box-content').addClass('container'); 
   $(".form-input-box input").keyup(function(key){
        $(this).css({'background-color':'#FDD', 'border-color': '#900'});
        if( $(this).attr("id")=='field-costo' || $(this).attr("id")=='field-pvp '|| $(this).attr("id")=='field-codigo'){
             if( !isNaN($(this).val()) && $(this).val()!=""){
                 $(this).css({'background-color':'#ABEBC6  ', 'border-color': '#00b300  '});
             }
        }else{
             if( $(this).val().match(/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/)
                ){
                    console.log('cdcd'); 
                     $(this).css({'background-color':'#ABEBC6', 'border-color': '#00b300 '});
                 }
        }      
   });   
   
    
});