$(document).ready( function() {
    $("#messageSend").click( function() {
        var message = $.trim($("#userMessage").val());
        if (message != "") {
            $(".chatBox").append( "<div class = \"message\">"+ message + "</div>" );
        }
    });

    $("#timeIcon").click( function() {
      $("#locationIcon").css("background", "black");
      $("#calendarIcon").css("background", "black");
      $("#timeIcon").css("background", "grey");
      $("#sideBarContent").text = "time preferences tab";
    });
    $("#locationIcon").click( function() {
      $("#timeIcon").css("background", "black");
      $("#calendarIcon").css("background", "black");
      $("#locationIcon").css("background", "grey");
      $("#sideBarContent").text = "location preferences tab";
    });
    $("#calendarIcon").click( function() {
      $("#locationIcon").css("background", "black");
      $("#timeIcon").css("background", "black");
      $("#calendarIcon").css("background", "grey");
      $("#sideBarContent").text = "upcoming meetings";
    });
})
