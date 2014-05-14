function initialize() {
    $('body').on('click', '.event', function(e) {

        if ($('#credentials').attr('data-group') === 'doctor')
        {
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
                    var dialog = null;

                    dialog = emptySettings(isEmpty, dialog, target);
                    measurementSettings(isMeasurement, dialog, target);

                    
                    var newContent = $(dialog).html();
                    //content.html(newContent);
                    var form = $(dialog).children().first();
                    var formClone = form.clone(true, true);
                    formClone.appendTo(content);
                }
            });
        }

    });

}

$(document).ready(initialize);

function measurementSettings(isMeasurement, dialog)
{
    var div = $(dialog).find('#measurementsDiv');
    if (isMeasurement)
        div.show();
    else
        div.hide();
}

function emptySettings(isEmpty, dialog, target)
{
    if (isEmpty) {
        dialog = $('#doctorEventDialog');
        fillWithData(dialog, target);
    } else {
        dialog = $('#cancelEventDialog');
        dialog.children().first().attr('data-id', target.attr('data-id'));
    }
    return dialog;
}

function getTimeOfEvent(event) {
    var index = event.index() + 1;
    var li = $(".meter li:nth-child(" + index + ")" )
    var em = li.find('em');
    var time = em.html();
    return time;
}

function fillWithData(dialog, target)
{
    dialog.find('#patientName').html($('#selectPatientSchedule :selected').text());
    dialog.find('#date').html($('#schedulerDate').val());
    var time = getTimeOfEvent(target);
    dialog.find('#hour').html(time);
    
    var activityMap = Object();
    activityMap['dietStream'] = 'Diet';
    activityMap['medicinesStream'] = 'Medicines';
    activityMap['exercisesStream'] = 'Exercises';
    activityMap['doctorStream'] = "Doctor's visits";
    activityMap['measurementsStream'] = "Measurements";
    
    var parent = target.parent();
    var parentId = parent.attr('id');
    var activity = activityMap[parentId];
    var activityType = dialog.find('#activityType');
    activityType.html(activity);
}