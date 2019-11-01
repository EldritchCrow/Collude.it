$(document).ready( function() {
    $("#messageSend").click( function() {
        var message = $.trim($("#userMessage").val());
        if (message != "") {
            $(".chatBox").append( "<div class = \"message\">"+ message + "</div>" );
        }
    });

    $("#timeIcon").click( function() {
      $("#locationIcon").css("background", "#666");
      $("#calendarIcon").css("background", "#666");
      $("#timeIcon").css("background", "grey");
      $("#sideBarContent").text("time preferences tab");
    });
    $("#locationIcon").click( function() {
      $("#timeIcon").css("background", "#666");
      $("#calendarIcon").css("background", "#666");
      $("#locationIcon").css("background", "grey");
      $("#sideBarContent").text("location preferences tab");
    });
    $("#calendarIcon").click( function() {
      $("#locationIcon").css("background", "#666");
      $("#timeIcon").css("background", "#666");
      $("#calendarIcon").css("background", "grey");
      $("#sideBarContent").text("upcoming meetings");
    });
})
