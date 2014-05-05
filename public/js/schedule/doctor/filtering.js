$(document).ready(function() {

    $('#selectPatientSchedule').change(updateStreamer);
    $("#datepicker").datepicker({
       selected : function(d, d0){
                alert('lol');
            }
    });

});

updateStreamer = function()
{
    alert('new streamer is incoming ' 
            + $('#credentials').attr("data-id") 
            + "  "
            + $('#selectPatientSchedule').val());
};