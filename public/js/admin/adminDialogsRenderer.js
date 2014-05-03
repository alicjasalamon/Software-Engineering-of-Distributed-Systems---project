$(document).ready(function() {
    
    $("button#open-add-institution-dialog").on('click', function() {
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

    $("button#open-add-doctor-dialog").on('click', function() {
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

    $("button#open-add-patient-dialog").on('click', function() {
        $.Dialog({
            overlay: true,
            shadow: true,
            flat: true,
            icon: '<i class="icon-accessibility"></i>',
            title: 'Add new patient',
            content: '',
            onShow: function(_dialog) {
                var content = _dialog.children('.content');
                var firstChild = $('#addPatientForm').children().first();
                firstChild.clone(true, true).appendTo(content);
            }
        });
    });
});