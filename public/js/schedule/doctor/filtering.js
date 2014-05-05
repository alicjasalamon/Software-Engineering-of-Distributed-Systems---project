$(document).ready(function() {
   // filterPatientsForDoctor();
    $('#selectPatientSchedule').change(updateStreamer);


    $("#datepicker").datepicker({selected: function(dateString, dateObject) {
        alert('date-selected');
    }});

    $('#schedulerDate').change(updateStreamer);

});

updateStreamer = function()
{
    alert('new streamer is incoming ' 
            + $('#credentials').attr("data-id") 
            + "  "
            + $('#selectPatientSchedule').val());
};