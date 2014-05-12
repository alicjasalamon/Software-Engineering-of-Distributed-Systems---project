$('document').ready(function() {

    var credentials = $('#credentials');
    var group = credentials.attr('data-group');
    if (group === 'doctor')
    {
        var doctorID = credentials.attr('data-id');
        $.ajax('/db/measurements', {
            data: {
                doctorid: doctorID ,
            }
        }).success(function(data) {
            var measurements = data.data;

        });
    }
});