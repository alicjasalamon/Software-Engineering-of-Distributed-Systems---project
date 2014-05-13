$(document).ready(function() {
    $('body').on('click', '.event', function(e) {

        var target = $(e.currentTarget);
        var isEmpty = (target.children().length === 0);
        var isMeasurement = target.parent().is('#measurementsStream');
        
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
                
                measurementSettings(isMeasurement, dialog);
                   
                var newContent = $(dialog).html();
                content.html(newContent);
            }
        });

    });
});

function basicInformationFill()
{
    
}

function measurementSettings(isMeasurement, dialog)
{
    var div = dialog.find('#measurementsDiv');
    if(isMeasurement)   
        div.show();
    else
        div.hide();
}