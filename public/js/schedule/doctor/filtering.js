$(document).ready(function() {
    filterPatientsForDoctor();
    $('#selectPatientSchedule').change(updateStreamer);


    $("#datepicker").datepicker({selected: function(dateString, dateObject) {
        alert('date-selected');
    }});

    $('#schedulerDate').change(updateStreamer);

});

filterPatientsForDoctor = function() {

};

updateStreamer = function()
{
    alert('new streamer is incoming');
};