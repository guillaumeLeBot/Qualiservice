document.addEventListener('DOMContentLoaded', function () {
    let calendarElt = document.querySelector("#calendar")
    let calendar = new FullCalendar.Calendar(calendarElt, {
        initialView: 'timeGridDay',
        locale: 'fr',
        timeZone: 'Europe/Paris',
        headerToolbar: {
            start: 'prev,next, timeGridDay,list',
            center: 'title',
            end: 'dayGridMonth,timeGridWeek'
        },
        buttonText: {
            day: 'Jour',
            week: 'Semaine',
            month: 'Mois',
            list: 'Liste'
        },
        events: {{ data| raw }},
    nowIndicator: true,
    editable: true,
    eventResizableFromStart: true,
        })
calendar.on('eventChange', (e) => {
    let url = `/api/${e.event.id}/edit`
    let donnees = {
        "title": e.event.title,
        "description": e.event.extendedProps.description,
        "start": e.event.start,
        "end": e.event.end,
        "backgroundColor": e.event.backgroundColor,
        "borderColor": e.event.borderColor,
        "textColor": e.event.textColor,
        "allDay": e.event.allDay
    }

    let ajaxRequest = new XMLHttpRequest();
    ajaxRequest.open("PUT", url, true)
    ajaxRequest.send(JSON.stringify(donnees))

})
calendar.on('eventClick', (e) => {
    // open the modal
    $('#modal').modal('show');
    // set the modal's title to the event's title
    $('#modal-title').text(e.event.title);

    // set the modal's background color to the event's color
    $('#background-color').val(e.event.backgroundColor);
    // set the modal's text color to the event's text color
    $('#text-color').val(e.event.textColor);

});

// save changes and close the modal when the save button is clicked
$('#save-button').click((e) => {
    // update the event's title
    e.event.title.setProp('title', $('#title').val());
    // update the event's background color
    e.event.backgroundColor.setProp('backgroundColor', $('#background-color').val());
    // update the event's text color
    e.event.textColor.setProp('textColor', $('#text-color').val());
    // update the calendar
    calendar.updateSize(e);
    // close the modal
    $('#modal').modal('hide');

});
calendar.render()
