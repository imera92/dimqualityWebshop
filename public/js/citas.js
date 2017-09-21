$(document).ready(function() {

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        defaultDate: '2017-09-12',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: 'tablet dañada, pnatalla no responde',
                start: '2017-09-01'
            },
            {
                title: 'Cita a domicilio - repacración aire',
                start: '2017-09-07'
            }

        ]
    });

});
