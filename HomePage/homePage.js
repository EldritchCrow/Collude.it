    var lastSelectedRow;
    var trs;
    var isMouseDown = false;
    var days = ["Sundays", "Mondays", "Tuesdays", "Wednesdays", "Thursdays", "Fridays", "Saturdays"];

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

  $('#contentTime').hide();

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

    trs = document.getElementById('timesTable').tBodies[0].getElementsByTagName('tr');
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

// disable text selection
document.onselectstart = function() {
  return false;
}

function RowClick(currenttr, lock) {

  if (window.event.ctrlKey) {
    toggleRow(currenttr);
    isMouseDown = true;
  }

  if (window.event.button === 0) {
    if (!window.event.ctrlKey && !window.event.shiftKey) {
      clearAll();
      toggleRow(currenttr);
      isMouseDown = true;
    }

    if (window.event.shiftKey) {
      selectRowsBetweenIndexes([lastSelectedRow.rowIndex, currenttr.rowIndex])
    }
  }
}

function RowOver(e, lock){
  if(isMouseDown){
    toggleRow(e);
  }
}

function MouseUp(e, lock){
  isMouseDown = false;
}

function toggleRow(row) {
  row.className = row.className == 'selected' ? '' : 'selected';
  lastSelectedRow = row;
}

function selectRowsBetweenIndexes(indexes) {
  indexes.sort(function(a, b) {
    return a - b;
  });

  for (var i = indexes[0]; i <= indexes[1]; i++) {
    trs[i-1].className = 'selected';
  }
}

function clearAll() {
  for (var i = 0; i < trs.length; i++) {
    trs[i].className = '';
  }
}

function Tomorrow(e){
  var string = $('#day').text();
  var index = getIndex(string);
  if (index == 6){
    $('#day').text(days[0]);
  }else{
    $('#day').text(days[index+1]);
  }
  clearAll();
}

function Yesterday(e){
  var string = $('#day').text();
  var index = getIndex(string);
  if (index == 0){
    $('#day').text(days[6]);
  }else{
    $('#day').text(days[index-1]);
  }
  clearAll();
}

function getIndex(query){
  var ret = 0;
  var i = 0;
  days.forEach(function(item){
    if (item == query ){
      ret = i;
    }
    i++;
  });
  return ret;
}
