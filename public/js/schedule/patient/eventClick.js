$(document).ready(function() {
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
                    var dialog = $('#patientEventDialog');

                    addMeasurementFeatures(target, dialog);

                    var detailsStreamer = $(target).find('.details');
                    var detailsDialog = dialog.find('.details');

                    detailsDialog.html(detailsStreamer.html());
                    var newContent = $(dialog).html();
                    content.html(newContent);
                }
            });
        }

    });
});

function addMeasurementFeatures(target, dialog)
{
    var clickedEvent = $(target);
    var measurementElems = dialog.find('#measurementField')
    if (clickedEvent.hasClass('measurements'))
    {
        var type = $(target).attr('data-measurement-type');
        measurementElems.show();
        var unitsMap = new Object();
        unitsMap['weight'] = 'kg';
        unitsMap['bloodPreasure'] = 'mmHg';
        unitsMap['sugarLevel'] = 'mmol/L';

        var unit = unitsMap[type];
        dialog.find('#unit').html(unit);

    }
    else
    {
        dialog.find('#unit').html('');
        measurementElems.hide();
    }
}
;