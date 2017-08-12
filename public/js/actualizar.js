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