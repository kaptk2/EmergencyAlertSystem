var text_max = 140;

$('#message').keyup(function() {
    var text_length = $('#message').val().length;
    var text_remaining = text_max - text_length;

    $('#feedback').html(text_remaining + ' characters remaining');
});
