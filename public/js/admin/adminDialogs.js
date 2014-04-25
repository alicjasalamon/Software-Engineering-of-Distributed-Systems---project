$(document).ready(function() {


    $("#addNewIstitutionButton").on('click', function() {
        $.Dialog({
            overlay: true,
            shadow: true,
            flat: true,
            icon: '<i class="icon-accessibility"></i>',
            title: 'Add new institution',
            content: '',
            onShow: function(_dialog) {
                var content = _dialog.children('.content');
                var firstChild = $('#addInstitutionForm').children().first();
                firstChild.clone(true, true).appendTo(content);
            }
        });
    });

    $("#addNewDoctor").on('click', function() {
        $.Dialog({
            overlay: true,
            shadow: true,
            flat: true,
            icon: '<i class="icon-accessibility"></i>',
            title: 'Add new doctor',
            content: '',
            onShow: function(_dialog) {
                var content = _dialog.children('.content');
                var firstChild = $('#addDoctorForm').children().first();
                firstChild.clone(true, true).appendTo(content);
            }
        });
    });

    $("#addNewPatient").on('click', function() {
        $.Dialog({
            overlay: true,
            shadow: true,
            flat: true,
            icon: '<i class="icon-accessibility"></i>',
            title: 'Add new patient',
            content: '',
            onShow: function(_dialog) {
                var content = _dialog.children('.content');
                var newContent = $('#addPatientForm').html();
                content.html(newContent);
            }
        });
    });

    $("#createNewBinding").on('click', function() {
        $.Dialog({
            overlay: true,
            shadow: true,
            flat: true,
            icon: '<i class="icon-accessibility"></i>',
            title: 'Create new binding',
            content: '',
            onShow: function(_dialog) {
                var content = _dialog.children('.content');
                var newContent = $('#createBindingForm').html();
                content.html(newContent);
            }
        });
    });

    $('#sumbit-add-institution-button').on('click', function(e) {
        var form = $(this).parentsUntil('form').parent();
        var serializedForm = form.serializeArray();
        $.ajax({type: "POST", url: "db/institution/add", data: serializedForm}).success(function(data) {
            var institution = data.data;
            var select = $('.fillWithInstitutions');
            var option = $('<option/>');
            option.html(institution.name);
            option.val(institution.id.$id);
            select.append(option);
        });
        $.Dialog.close();
    });

    $('.submit-add-doctor-button').on('click', function(e) {
        var form = $(this).parentsUntil('form').parent();
        var serializedForm = form.serializeArray();
        $.ajax({type: "POST", url: "db/user/add", data: serializedForm}).success(function(data) {

            var doctorsTable = $('.fillWithDoctorsTable');

            var doctor = data.data;
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

            var selectD = $('.fillWithDoctors');
            doctorsTable.append(row);

            var option = $('<option/>');
            option.html(doctor.firstname + " " + doctor.lastname);
            option.val(doctor.id.$id);

            selectD.append(option);

        });
        $.Dialog.close();
    });

});