$('document').ready(function()
{

    //$('body').on('click', '.submit-new-event', function(e) {
    $('.submit-new-event').click(function(e) {

        var form = $(this).parentsUntil('form').parent();
        

        $('input[name="patientid"]').val($('#selectPatientSchedule').val());
        var date = $('#schedulerDate').val();
        $('#date').val(date);
        $('input[name="date"]').val(date);
        var time = $('span#hour').html();
        $('#time').val(time);
        $('input[name="time"]').val(time);

        var activityMap = new Object();
        var activityKey = $('span#activityType').html();
        activityMap['Diet'] = 'diet';
        activityMap['Exercises'] = 'exercises';
        activityMap['Medicines'] = 'medicines';
        activityMap["Doctor's visits"] = 'visits';
        activityMap['Measurements'] = 'measurements';

        var activity = activityMap[activityKey];
        $('#activity').val(activity);
        $('input[name="activity"]').val(activity);

        var serializedForm = form.serializeArray();
        $.ajax({type: "POST", url: "db/event/add", data: serializedForm
        }).success(function(data) {
            console.log(JSON.stringify(data));
        });

        $.Dialog.close();
    });
});