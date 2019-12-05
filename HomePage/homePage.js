$(document).ready( function() {
    $("#messageSend").click( function() {
        sendMessage();
    });
    $(document).on('keyup',function(e) {
    if(e.which == 13) {
        sendMessage();
    }
  });

  function sendMessage() {
    var user_message = $.trim($("#userMessage").val());
    $("#userMessage").val("");
    $.ajax({
      type: "POST",
      url: "user_functions/sendMessage.php",
      data: {message: user_message},
      dataType: "text",
      success: function(data, status) {
        // alert(status + " : " + data);
        // console.log(data);
      },
      error: function(data, status) {
        alert(status + " : " + data);
        console.log(data);
      },
    });
  }

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

    $(".expand-close").click( function() {
        $(".notificationBar").css("display", "none");
        $(".content").css("display", "none");
        $(".tabs").css("display", "block");
        $(".arrow").html("&gt;");
    });
    
    $(".chatBox").delay(500).animate({scrollTop: $(".chatBox").prop("scrollHeight")}, "slow");
});

function loadMessageLog() {
  var old_height = $(".chatBox").prop("scrollHeight");
  $.ajax({
    type: "GET",
    url: "user_functions/loadMessages.php",
    dataType: "json",
    success: function(data, status) {
      var new_text = ""
      data.data.forEach(function(item, index) {
        new_text += "<div class='message'>" + item.name + ": " + item.message + "</div>";
      });
      $(".chatBox").html(new_text);
      var new_height = $(".chatBox").prop("scrollHeight");
      console.log(old_height + " : " + new_height);
      if(new_height > old_height) {
        $(".chatBox").animate({scrollTop: new_height}, "slow");
        console.log("Tried to scroll");
      }
    }
  });
}

setInterval(loadMessageLog, 1000);