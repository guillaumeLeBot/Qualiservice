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
    customButtons: {
    addEventButton: {
        text: 'Add Event',
        click: function () {
            $('#modal').modal('show');
        }
    }
},
    eventRender: function (event, element) {
        // Add the event fields to the element
        element.find('.fc-title').append("<br/><span class='small'>" + event.pallets_number + "</span>");
        element.find('.fc-title').append("<br/><span class='small'>" + event.description + "</span>");
        element.find('.fc-title').append("<br/><span class='small'>" + event.building + "</span>");
        element.find('.fc-title').append("<br/><span class='small'>" + event.supplier + "</span>");
        element.find('.fc-title').append("<br/><span class='small'>" + event.customer + "</span>");
        element.find('.fc-title').append("<br/><span class='small'>" + event.driver + "</span>");
        element.find('.fc-title').append("<br/><span class='small'>" + event.merchandise + "</span>");
        // Add the tooltips
        element.attr("data-toggle", "tooltip");
        element.attr("data-html", "true");
        element.attr("title", `Pallets Number: ${event.pallets_number}<br>
                                Description: ${event.description}<br>
                                Building: ${event.building}<br>
                                Supplier: ${event.supplier}<br>
                                Customer: ${event.customer}<br>
                                Driver: ${event.driver}<br>
                                Merchandise: ${event.merchandise}`);
    },
            
        })
calendar.on('eventChange', (e) => {
    let url = `/api/${e.event.id}/edit`
    let donnees = {
        "title": e.event.title,
        "description": e.event.extendedProps.description,
        "start": e.event.start,
        "end": e.event.end,
        "allDay": e.event.allDay,
        "pallets_number": e.event.extendedProps.pallets_number,
        "building": e.event.building,
        "supplier": e.event.supplier,
        "customer": e.event.customer,
        "driver": e.event.driver,
        "merchandise": e.event.merchandise
    }

    let ajaxRequest = new XMLHttpRequest();
    ajaxRequest.open("PUT", url, true)
    ajaxRequest.send(JSON.stringify(donnees))

})
calendar.on('eventClick', (e) => {
    window.location.href = `/calendar/${e.event.id}/edit`;
});
$('#save-button').on('click', function () {
    let eventData = {
        title: $('#title').val(),
        backgroundColor: $('#background-color').val(),
        textColor: $('#text-color').val()
    };

    $.ajax({
        url: '/calendar/new',
        method: 'POST',
        data: JSON.stringify(eventData),
        success: function (response) {
            // Add the new event to the calendar
            calendar.addEvent(response);
            // Hide the modal form
            $('#modal').modal('hide');
        }
    });
});
calendar.on('dayClick', function (date, jsEvent, view) {
    let allEvents = calendar.getEvents();
    let isEvent = allEvents.some(function (event) {
        return event.start <= date && event.end > date;
    });
    if (!isEvent) {
        window.location.href = '/calendar/new?date=' + date.toISOString();
    }
});

calendar.render()
$('[data-toggle="tooltip"]').tooltip();
})