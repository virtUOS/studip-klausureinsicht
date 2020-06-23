$(document).ready(function(){
    $('#er-exams-select-user').select2();

    $('#er-exams-select-user').change(function(){
        let url = ($(this).val());
        let viewer = $('#er-exams-viewer');
        let fileFound = $(this).find(':selected').attr('data-found') == 1;
        let username = $(this).find(':selected').attr('data-vorname') + ' ' +$(this).find(':selected').attr('data-nachname');
        if(fileFound) {
            viewer.attr('src', url);
            $('.er-exams-file-not-found').hide();
            $('.er-exams-current-exam-username').text(username);
            $('.er-exams-label-exam').show();
            viewer.show();
        } else {
            $('#er-exam-username').text(username);
            $('.er-exams-file-not-found').show();
            viewer.hide();
            $('.er-exams-label-exam').hide();
        }
    });

    $('#er-exams-select-user').trigger('change');
});
