function submitEvent(e) {
    var eventID = $(e.currentTarget).parent().parent().attr('data-id');
    $.ajax({type: "POST", url: "db/event/state", data: {
            id: eventID,
            state: "done"
        }}).success(function(data) {
        updateStreamer();
    });
    $.Dialog.close();
}
    