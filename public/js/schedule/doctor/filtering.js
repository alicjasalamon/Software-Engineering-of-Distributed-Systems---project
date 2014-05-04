$(document).ready(function (){
   
    filterPatientsForDoctor();
    $('#selectPatientSchedule').change(function ()
    {
        updateStreamer();
    });

    //on patient change
    //on date change
    
});

filterPatientsForDoctor = function (){
    
};

updateStreamer = function ()
{
    alert('new streamer is incoming');
};