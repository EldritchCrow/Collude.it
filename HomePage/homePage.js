$(document).ready( function() {
    $("#messageSend").click( function() {
        var message = $.trim($("#userMessage").val());
        if (message != "") {
            $(".chatBox").append( "<div class = \"message\">"+ message + "</div>" );
        }
    });
})