$(document).ready(function() {
    $('#Igor-profiler-button').on('click', function() {
        display = $('#Igor-profiler-content').css('display') == 'block' ? 'none' : 'block';

        $('#Igor-profiler-content').css('display', display);
    });
});