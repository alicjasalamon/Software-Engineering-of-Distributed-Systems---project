$(document).ready(function() {

    /**
     * ******************** INSTITUTIONS ******************
     */
    var select = $('.fillWithInstitutions');
    $.ajax('/db/institution/all').success(function(data) {
        var institutions = data.data;
        for (var i = 0; i < institutions.length; i++) {

            var institution = institutions[i];

            var option = $('<option/>');
            option.html(institution.name);
            option.val(institution.id.$id);

            select.append(option);
        }
    });

    /**
     * ******************** DOCTORS ******************
     */
    var doctors;
    var doctorsTable = $('.fillWithDoctorsTable');
    $.ajax('/db/doctor/all').success(function(data) {
        doctors = data.data;
        for (var i = 0; i < doctors.length; i++) {

            var doctor = doctors[i];

            var row = $('<tr/>');

            var tdFirstName = $('<td/>');
            tdFirstName.html(doctor.firstname);
            row.append(tdFirstName);

            var tdLastName = $('<td/>');
            tdLastName.html(doctor.lastname);
            row.append(tdLastName);

            var tdLogin = $('<td/>');
            tdLogin.html(doctor.email);
            row.append(tdLogin);


            var tdEmail = $('<td/>');
            tdEmail.html(doctor.email);
            row.append(tdEmail);


            doctorsTable.append(row);
        }
    /**
     * ******************** PATIENTS ******************
     */
    var patientsTable = $('.fillWithPatientsTable');
    $.ajax('/db/patient/all').success(function(data) {
        var patients = data.data;
        for (var i = 0; i < patients.length; i++) {

            var patient = patients[i];

            var row = $('<tr/>');

            var tdFirstName = $('<td/>');
            tdFirstName.html(patient.firstname);
            row.append(tdFirstName);

            var tdLastName = $('<td/>');
            tdLastName.html(patient.lastname);
            row.append(tdLastName);

            var tdLogin = $('<td/>');
            tdLogin.html(patient.email);
            row.append(tdLogin);


            var tdEmail = $('<td/>');
            tdEmail.html(patient.email);
            row.append(tdEmail);
            
            var tdDoctor = $('<td/>');
            for (var j = 0; j < doctors.length; j++) {
                var doctor = doctors[j];
                if(patient.doctor === doctor.id)
                 tdDoctor.html(doctor.firstname + " " + doctor.lastname);
            }
            row.append(tdDoctor);           

            
            patientsTable.append(row);
        }
    });
        
    });

    var selectD = $('.fillWithDoctors');
    $.ajax('/db/doctor/all').success(function(data) {
        var doctors = data.data;
        for (var i = 0; i < doctors.length; i++) {
            var doctor = doctors[i];

            var option = $('<option/>');
            option.html(doctor.firstname + " " + doctor.lastname);
            option.val(doctor.id.$id);

            selectD.append(option);
        }
        
    });



    var selectP = $('.fillWithPatients');
    $.ajax('/db/patient/all').success(function(data) {
        var patients = data.data;
        for (var i = 0; i < patients.length; i++) {
            var patient = patients[i];

            var option = $('<option/>');
            option.html(patient.firstname + " " + patient.lastname);
            option.val(patient.id.$id);

            selectP.append(option);
        }
    });


});