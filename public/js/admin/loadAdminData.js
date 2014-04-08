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
    var doctorsTable = $('.fillWithDoctorsTable');
    $.ajax('/db/doctor/all').success(function(data) {
        var doctors = data.data;
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


            patientsTable.append(row);
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


/*
 $('<option/>', {
 //     class: 'po nm',
 });
 */