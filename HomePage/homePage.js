$(document).ready( function() {
    $("#messageSend").click( function() {
        var message = $.trim($("#userMessage").val());
        if (message != "") {
            $(".chatBox").append( "<div class = \"message\">"+ message + "</div>" );
            $("#userMessage").val("");
        }
    });
    $(document).on('keyup',function(e) {
    if(e.which == 13) {
        var message = $.trim($("#userMessage").val());
        if (message != "") {
            $(".chatBox").append( "<div class = \"message\">"+ message + "</div>" );
        }
        $("#userMessage").val("");
        $("#userMessage").attr("placeholder", "Type your message here.");

    }
  });

    $("#timeIcon").click( function() {
      $("#locationIcon").css("background", "#666");
      $("#calendarIcon").css("background", "#666");
      $("#timeIcon").css("background", "grey");
      $("#sideBarContent").text("time preferences tab");
      $("#notifBar").text("Notifications");
    });
    $("#locationIcon").click( function() {
      $("#timeIcon").css("background", "#666");
      $("#calendarIcon").css("background", "#666");
      $("#locationIcon").css("background", "grey");
      $("#sideBarContent").text("location preferences tab");
      $("#notifBar").text("Notifications");
    });
    $("#calendarIcon").click( function() {
      $("#locationIcon").css("background", "#666");
      $("#timeIcon").css("background", "#666");
      $("#calendarIcon").css("background", "grey");
      $("#sideBarContent").text("upcoming meetings tab");
      $("#notifBar").text("Request a meeting");
    });
})
