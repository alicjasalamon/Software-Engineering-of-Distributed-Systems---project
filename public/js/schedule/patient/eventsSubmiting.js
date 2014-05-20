function submitEvent(e) {
    var dialog = $(e.currentTarget).parent().parent();
    var eventID = dialog.attr('data-id');
    $.ajax({type: "POST", url: "db/event/state", data: {
        id: eventID,
        state: "done"
    }}).success(function(data) {
        updateStreamer();
    });
    $.Dialog.close();
}

function submitMeasurement(e) {
    var dialog = $(e.currentTarget).parent().parent();
    var eventID = dialog.attr('data-id');
    var input = dialog.find('input');
    $.ajax({type: "POST", url: "db/event/measurement", data: {
        id: eventID,
        measurementvalue: input.val(),
    }});
}
    