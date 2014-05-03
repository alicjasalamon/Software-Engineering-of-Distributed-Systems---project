$(document).ready(function() {

    $('button#submit-add-institution').on('click', function() {
        var form = $(this).parentsUntil('form').parent();
        var serializedForm = form.serializeArray();
        $.ajax({type: "POST", url: "db/institution/add", data: serializedForm}).success(function(data) {
            var institution = data.data;
            renderInstitution(institution);
        });
        $.Dialog.close();
    });

    $('button#submit-add-doctor').on('click', function() {
        var form = $(this).parentsUntil('form').parent();
        var serializedForm = form.serializeArray();
        $.ajax({type: "POST", url: "db/user/add", data: serializedForm}).success(function(data) {
            var doctor = data.data;
            renderDoctor(doctor);
        });
        $.Dialog.close();
    });

    $('button#submit-add-patient').on('click', function() {
        var form = $(this).parentsUntil('form').parent();
        var serializedForm = form.serializeArray();
        $.ajax({type: "POST", url: "db/user/add", data: serializedForm}).success(function(data) {
            var patient = data.data;
            var doctor = doctors.filter(function (d){
                   return d.id===patient.doctor;
               });
            renderPatient(patient, doctor[0]);
        });
        $.Dialog.close();
    });
    
    var filterRows = function (tableName, value){
     
        var usersTrs = $(tableName).find('tr');
        
        for(var i=0; i<usersTrs.length; i++)
        {
            var row = $(usersTrs[i]);
            var institution = row.attr('data-institution');
            if(institution !== value && value!=='all')
            {
                row.hide();
            }
            else 
            {
                row.show();
            }
        }
    };
    
    $('select#filterUsers').on('change', function(){
        var value = $(this).val();
        filterRows('#patientsTable', value);
        filterRows('#doctorsTable', value);
    });

});