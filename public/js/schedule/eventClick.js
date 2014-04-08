$('body').on('click', '.event', function() {
    
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
                var newContent = $('#patientEventDialog').html();
                content.html(newContent);
            }
        });
    }
});
