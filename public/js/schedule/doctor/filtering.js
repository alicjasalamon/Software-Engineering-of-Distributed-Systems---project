$(document).ready(function() {

    $('#selectPatientSchedule').change(updateStreamer);

});

updateStreamer = function()
{

    var patientID = ($('#selectPatientSchedule').length === 0) ? $('#credentials').attr("data-id") : $('#selectPatientSchedule').val();
    var date = $('#datepicker').attr('data-date');

    $.ajax({type: "POST", url: "db/day", data: {
            patientid: "53690e4e87dba0d8100000bb",
            date: "18/04/2014",
        }}).success(function(data) {

        var streams = data.data.streams;
        for (var i = 0; i < streams.length; i++)
        {
            var events = streams[i].events;
            var stream = $('.event-stream')[i];

            addEvents(stream, events, streams[i].activity);
        }
    });
};

function start(time)
{
    var hour = time.split(':')[0];
    var min = time.split(':')[1];

    var num = 0;

    num += min / 15;
    num += (hour - 6) * 4;

    return num;

}


function addEvents(stream, events, activity)
{

    for (var i = 0; i < events.length; i++)
    {
        var event = events[i];
        var index = start(event.time);



        var eventDiv = $(stream).find('.empty')[index];
        eventDiv = $(eventDiv);


        var dur = event.duration / 15;
        spreadEvent(eventDiv, dur);

        fillEvent(eventDiv, event);

        setColor(event, eventDiv, activity);


    }
}

function spreadEvent(eventDiv, dur)
{
    if (dur === 2)
    {
        eventDiv.addClass('double');
        eventDiv.next().hide();
    }
    else if (dur === 3)
    {
        eventDiv.addClass('triple');
        eventDiv.next().hide();
        eventDiv.next().next().hide();
    }
    else if (dur === 4)
    {
        eventDiv.addClass('quadro');
        eventDiv.next().hide();
        eventDiv.next().next().hide();
        eventDiv.next().next().next().hide();
    }
}

function fillEvent(eventDiv, event)
{
    var hour = $('<h5/>');
    hour.html(event.time);
    eventDiv.append(hour);

    var title = $('<h2/>');
    title.html(event.title);
    eventDiv.append(title);

    var details = $('<div/>');
    details.html(event.details);
    details.hide();
    details.addClass('details');
    eventDiv.append(details);
}

function setColor(event, eventDiv, activity)
{
    if (activity === 'diet')
    {
        if (event.state !== 'done')
            eventDiv.addClass('bg-teal');
        else
            eventDiv.addClass('ribbed-tead');
    }
    else if (activity === 'exercises')
    {
        if (event.state !== 'done')
            eventDiv.addClass('bg-pink');
        else
            eventDiv.addClass('ribbed-pink');
    }

    else if (activity === 'medicines')
    {
        if (event.state !== 'done')
            eventDiv.addClass('bg-green');
        else
            eventDiv.addClass('ribbed-green');
    }

    else if (activity === 'visits')
    {
        if (event.state !== 'done')
            eventDiv.addClass('bg-steel');
        else
            eventDiv.addClass('ribbed-steel');
    }
    else
        eventDiv.addClass('bg-red');
}