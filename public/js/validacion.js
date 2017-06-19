$(document).ready(function(){
   $('#cancel-button').addClass("btn-danger");
   $('#form-button-save').addClass("btn-success");
   $('.form-field-box').addClass("form-group");
   $(".form-input-box input").addClass("form-control");
   $('#save-and-go-back-button').addClass("btn-info");
   $('.box-content').addClass('container'); 
   $(".form-input-box input").keypress(function(tecla){
        if( $(this).attr("id")=='field-costo' || $(this).attr("id")=='field-pvp '|| $(this).attr("id")=='field-codigo'){
             if( tecla.charCode < 48 || tecla.charCode > 57){
               return false;
             }
        }else{
             console.log("entre");
             if((tecla.charCode < 97 || tecla.charCode > 122) && (tecla.charCode < 65 || tecla.charCode > 90) && (tecla.charCode != 45)) return false;
             
        }    
   });   
   
    
});