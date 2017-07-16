$(".form_datetime").datetimepicker({
    weekStart: 1,
    //todayBtn:  0,
    autoclose: 1,
    todayHighlight: 0,
    startDate: new Date(),
    pickerPosition: "bottom-left",
    language: 'es',
    daysOfWeekDisabled: '0,6',
    minuteStep: 60,
    viewSelect: 'hour'

});

var horasInactivas = [0,1,2,3,4,5,6,7,8,17,18,19,20,21,22,23]
$('.form_datetime').datetimepicker('setHoursDisabled', horasInactivas);

$("#citacreada").fadeOut(1500);
$("#citarepetida").fadeOut(1500);
$("#nodisponible").fadeOut(1500);
