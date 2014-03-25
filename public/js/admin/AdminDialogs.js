$("#addNewIstitutionButton").on('click', function(){
    $.Dialog({
        overlay: true,
        shadow: true,
        flat: true,
        icon: '<i class="icon-accessibility"></i>',
        title: 'Add new institution',
        content: '',
        onShow: function(_dialog){
            var content = _dialog.children('.content');
            var newContent = $('#addInstitutionForm').html();
            content.html(newContent);
        }
    });
});

$("#addNewDoctor").on('click', function(){
    $.Dialog({
        overlay: true,
        shadow: true,
        flat: true,
        icon: '<i class="icon-accessibility"></i>',
        title: 'Add new doctor',
        content: '',
        onShow: function(_dialog){
            var content = _dialog.children('.content');
            var newContent = $('#addDoctorForm').html();
            content.html(newContent);
        }
    });
});

$("#addNewPatient").on('click', function(){
    $.Dialog({
        overlay: true,
        shadow: true,
        flat: true,
        icon: '<i class="icon-accessibility"></i>',
        title: 'Add new patient',
        content: '',
        onShow: function(_dialog){
            var content = _dialog.children('.content');
            var newContent = $('#addPatientForm').html();
            content.html(newContent);
        }
    });
});

$("#createNewBinding").on('click', function(){
    $.Dialog({
        overlay: true,
        shadow: true,
        flat: true,
        icon: '<i class="icon-accessibility"></i>',
        title: 'Create new binding',
        content: '',
        onShow: function(_dialog){
            var content = _dialog.children('.content');
           var newContent = $('#createBindingForm').html();
            content.html(newContent);
        }
    });
});