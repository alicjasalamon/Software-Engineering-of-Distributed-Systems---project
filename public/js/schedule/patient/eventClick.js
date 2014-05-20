$(document).ready(function() {
    $('body').on('click', '.event', function(e) {

    if($('#credentials').attr('data-group')=== 'patient'){
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
                    var dialog = $('#patientEventDialog');

                    addMeasurementFeatures(target, dialog);

                    var detailsStreamer = $(target).find('.details');
                    var detailsDialog = dialog.find('.details');
                    
                   // dialog.children().first().attr('data-id', target.attr('data-id'));
                    
                    //detailsDialog.append(detailsDialog.clone(true, true).children());
                    detailsDialog.html(detailsStreamer.html());
                    var clone = $(dialog).clone(true, true);
                    var cloneChildren = clone.children();
                    var firstChild = cloneChildren.first();
                    firstChild.attr('data-id', $(target).attr('data-id'));
                    var newContent = clone.children();
                    content.append(newContent);
                    $('.submit-event-state').off('click', submitEvent);
                    $('.submit-event-state').on('click', submitEvent);
                    $('.submit-event-state').off('click', submitMeasurement);
                    if($(target).hasClass('measurements')) {
                        $('.submit-event-state').on('click', submitMeasurement);
                    }
                    
                }
            });
        }
    }
    });
    
});

function addMeasurementFeatures(target, dialog)
{
    var clickedEvent = $(target);
    var measurementElems = dialog.find('#measurementField');
    if (clickedEvent.hasClass('measurements'))
    {
        var type = $(target).attr('data-measurement-type');
        measurementElems.show();
        var unitsMap = new Object();
        unitsMap['weight'] = 'kg';
        unitsMap['blood-pressure'] = 'mmHg';
        unitsMap['sugar-level'] = 'mmol/L';
         
        var unit = unitsMap[type];
        dialog.find('.unit').html(unit);
        
        var eventId = clickedEvent.attr('data-id');
        dialog.attr('data-id', eventId);

    }
    else
    {
        dialog.find('.unit').html('');
        measurementElems.hide();
    }
}
;