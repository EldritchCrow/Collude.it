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
      $("#sideBarTimes").css("display", "inherit");
      $("#sideBarLocs").css("display", "none");
      $("#sideBarRequest").css("display", "none");
      $("#notifBar").text("Time Preferences");
    });
    $("#locationIcon").click( function() {
      $("#timeIcon").css("background", "#666");
      $("#calendarIcon").css("background", "#666");
      $("#locationIcon").css("background", "grey");
      $("#sideBarTimes").css("display", "none");
      $("#sideBarLocs").css("display", "inherit");
      $("#sideBarRequest").css("display", "none");
      $("#notifBar").text("Location Preferences");
    });
    $("#calendarIcon").click( function() {
      $("#locationIcon").css("background", "#666");
      $("#timeIcon").css("background", "#666");
      $("#calendarIcon").css("background", "grey");
      $("#sideBarTimes").css("display", "none");
      $("#sideBarLocs").css("display", "none");
      $("#sideBarRequest").css("display", "inherit");
      $("#notifBar").text("Request a meeting");
    });

    $(".expand-close").click( function() {
        $(".notificationBar").css("display", "none");
        $(".content").css("display", "none");
        $(".tabs").css("display", "block");
        $(".arrow").html("&gt;");
    });

    $("#addLocation").click(function() {
      var break_ = false;
      [...$(".locationSelector")].forEach(function(item, index) {
        if(item.val() == "") {
          alert("You must fill out all of the list items");
          break_ = true;
        }
      });
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
      if(new_height > old_height) {
        $(".chatBox").animate({scrollTop: new_height}, "slow");
      }
    }
  });
}

setInterval(loadMessageLog, 1000);