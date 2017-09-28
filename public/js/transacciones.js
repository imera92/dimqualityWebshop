$(document).ready(function () {
    $('#example').DataTable();
    $('#datetimepicker1').datetimepicker();
    $('#datetimepicker2').datetimepicker();
    $("#form2").validate({
        rules: {
            // simple rule, converted to {required:true}
            recibe:{ 
                required: true,
                number:false
            }
            
            ,cedula: {
                required: true,
                minlength: 9,
                number:true
            },direccion: {
                required:true,
                minlength:1
            }
        },messages: 
        {
            recibe: "Debe introducir la direccion",
            cedula : "El campo cedula es obligatorio.",
            direccion:"El campo direccion es obligatorio",
        }
    });
    $(".sub").click(function(){
        console.log("Ee");
        $("#form2").submit();   
    })
});