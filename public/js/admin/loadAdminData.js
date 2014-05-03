$(document).ready(function() {
    
    //$('input').val('monika_74');
   // $('.email').val('monika_74@zop.pl');

    /**
     * ******************** INSTITUTIONS ******************
     */
    $.ajax('/db/institution/all').success(function(data) {
        var institutions = data.data;
        for (var i = 0; i < institutions.length; i++) {
            var institution = institutions[i];
            renderInstitution(institution);
        }
    });

    /**
     * ******************** DOCTORS ******************
     */
    $.ajax('/db/doctor/all').success(function(data) {
        doctors = data.data;
        for (var i = 0; i < doctors.length; i++) {
            var doctor = doctors[i];
            renderDoctor(doctor);
        }
       /**
        * ******************** PATIENTS ******************
        */
       $.ajax('/db/patient/all').success(function(data) {
           var patients = data.data;
           for (var i = 0; i < patients.length; i++) {
               var patient = patients[i];
               var doctor = doctors.filter(function (d){
                   return d.id===patient.doctor;
               });
               renderPatient(patient, doctor[0]);
           }
       });
     });
    
});