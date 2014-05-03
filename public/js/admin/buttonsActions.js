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
            renderPatient(patient, doctor);
        });
        $.Dialog.close();
    });

});