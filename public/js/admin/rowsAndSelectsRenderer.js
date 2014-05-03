/**
* ******************** INSTITUTIONS ******************
*/
renderInstitution = function(institution) {

    var select = $('.fillWithInstitutions');
    var option = $('<option/>');
    option.html(institution.name);
    option.val(institution.id);
    select.append(option);
};

/**
* ******************** PATIENTS ******************
*/
renderPatient = function(patient, doctor) {
    var patientsTable = $('.fillWithPatientsTable');
    var row = $('<tr/>');
    
    var tdFirstName = $('<td/>');
    tdFirstName.html(patient.firstname);
    row.append(tdFirstName);
    
    var tdLastName = $('<td/>');
    tdLastName.html(patient.lastname);
    row.append(tdLastName);
    
    var tdLogin = $('<td/>');
    tdLogin.html(patient.login);
    row.append(tdLogin);
    
    var tdEmail = $('<td/>');
    tdEmail.html(patient.email);
    row.append(tdEmail);
    
    var tdDoctor = $('<td/>');
    tdDoctor.html(doctor.firstname + " " + doctor.lastname);
    row.append(tdDoctor);   
    
    patientsTable.append(row);
};

/**
* ******************** DOCTORS ******************
*/
renderDoctor = function(doctor) {
    renderDoctorInTable(doctor);
    renderDoctorInSelects(doctor);
};

renderDoctorInTable = function(doctor) {
    var doctorsTable = $('.fillWithDoctorsTable');
    var row = $('<tr/>');

    var tdFirstName = $('<td/>');
    tdFirstName.html(doctor.firstname);
    row.append(tdFirstName);

    var tdLastName = $('<td/>');
    tdLastName.html(doctor.lastname);
    row.append(tdLastName);

    var tdLogin = $('<td/>');
    tdLogin.html(doctor.login);
    row.append(tdLogin);

    var tdEmail = $('<td/>');
    tdEmail.html(doctor.email);
    row.append(tdEmail);

    doctorsTable.append(row);
};

renderDoctorInSelects = function(doctor) {
    var selectsDoctor = $('.fillWithDoctors');
    var option = $('<option/>');
    option.html(doctor.firstname + " " + doctor.lastname);
    option.val(doctor.id);
    selectsDoctor.append(option);
};