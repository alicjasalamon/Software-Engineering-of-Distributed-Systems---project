$(document).ready(function() {
    var select = $('#input-institution');
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


});


/*
$('<option/>', {
    //     class: 'po nm',
});
*/