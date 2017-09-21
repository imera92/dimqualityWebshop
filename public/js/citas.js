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
                title: 'All Day Event',
                start: '2017-09-01'
            },
            {
                title: 'Long Event',
                start: '2017-09-07',
                end: '2017-09-10'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2017-09-28'
            }
        ]
    });

});
