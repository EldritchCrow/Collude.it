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
    var message = $.trim($("#userMessage").val());
    if (message != "") {
        $(".chatBox").append( "<div class = \"message\" >"+ message + "</div>" );
    }
    $("#userMessage").val("");
    $("#userMessage").attr("placeholder", "Type your message here.");
    var d = $('.chatBox');
    d.scrollTop(d.prop("scrollHeight"));
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

    trs = document.getElementById('timesTable').tBodies[0].getElementsByTagName('tr');



});

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
}

function Yesterday(e){
  var string = $('#day').text();
  var index = getIndex(string);
  if (index == 0){
    $('#day').text(days[6]);
  }else{
    $('#day').text(days[index-1]);
  }
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
