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
    $.ajax({
      type: "POST",
      url: "user_functions/sendMessage.php",
      data: {message: user_message},
      dataType: "text",
      success: function(data, status) {
        alert(status + " : " + data);
        console.log(data);
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
})


// ------  Notification banner  ------ //

let notification = {};

(function(notify){


  notify.notice = function(content, opts){

    opts = $.extend( true, {

      type: 'primary', //primary, secondary, success, danger, warning, info, light, dark
      appendType: 'append', //append, prepend
      closeBtn: false,
       autoClose: 80000, // If you want auto close 
      className: '',

    }, opts);

    let $container = $('#alert-container-'+ opts.position);
    if(!$container.length){
      $container = $('<div id="alert-container-' + opts.position + '" class="alert-container"></div>');
      $('body').append($container);
    }

    let $el = $(`
      <div class="alert fade alert-${opts.type}" role="alert">${content}</div>
    `);

    if(opts.autoClose){
      $el
        .append(`
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        `)
        .addClass('alert-dismissible');
    }

    if(opts.autoClose){

      let t = setTimeout(() => {
        $el.alert('close');
      }, opts.autoClose);

    }

    opts.appendType === 'append' ? $container.append($el) : $container.prepend($el);

    setTimeout(() => {
      $el.addClass('show');
    }, 50);
    
    return;

  };

})(notification);
