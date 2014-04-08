$('body').on('click', '.event', function(e) {

    var target = e.currentTarget;
    if ($(this).children().length > 0)
    {
        $.Dialog({
            overlay: true,
            shadow: true,
            flat: true,
            icon: '<i class="icon-accessibility"></i>',
            title: 'Event details',
            content: '',
            onShow: function(_dialog) {

                var content = _dialog.children('.content');
               
                var patientEventDialog = $('#patientEventDialog');
               
                var detailsStreamer = $(target).find('.detailsStreamer');
                var detailsDialog = patientEventDialog.find('.detailsDialog');
               
                detailsDialog.html(detailsStreamer.html());

                var newContent = $(patientEventDialog).html();
                content.html(newContent);
            }
        });
    }
});
