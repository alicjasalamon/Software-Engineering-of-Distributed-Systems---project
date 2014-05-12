$(document).ready(function() {
    $('body').on('click', '.event', function(e) {

        var target = $(e.currentTarget);
        var isEmpty = (target.children().length === 0)
        var isMeasurement = target.hasClass('measurements');
        
        $.Dialog({
            overlay: true,
            shadow: true,
            flat: true,
            icon: '<i class="icon-accessibility"></i>',
            title: 'Event details',
            content: '',
            onShow: function(_dialog) {

                var content = _dialog.children('.content');
                var dialog = $('#doctorEventDialog');
                
                   
                var newContent = $(dialog).html();
                content.html(newContent);
            }
        });

    });
});

function basicInformationFill()
{
    
}