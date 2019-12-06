<?php

define("MAIN_APP_RUN", true);
require_once("library.php");

$login_attempt = null;
if (isset($_POST["login"])) {
    $login_attempt = loginUser($_POST["username"], $_POST["password"]);
    $message = $login_attempt["message"];
    if(!$login_attempt["success"]) {
      echo "<script type='text/javascript'>window.onload = function() { alert('$message');</script>";
    }
}

if(!checkSession()) {
  ob_start();
  header("Location: finalLandingPage.php");
  ob_flush();
  die();
}

if (isset($_POST["request_meeting"])) {
    echo requestMeeting($_POST["meeting_time"], $_POST["meeting_location"]);
} else if (isset($_POST["submitLocations"])) {
    echo addLocationPreferences($locations);
} else if (isset($_POST["submitTimes"])) {
    echo addTimePreferences($days);
} elseif (isset($_POST["send_message"])) {
    echo sendMessage($_POST["chat_info"]);
}

$message_data = loadMessages();
if(!$message_data["success"]) {
  $message = $message_data["message"];
  //echo "<script type='text/javascript'>window.onload = function() { alert('$message'); };</script>";
}
$message_data = $message_data["data"]

?>

<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../homePage/homepage.css">
    <title>Collude.IT</title>
  </head>
  <body>

  	<header class="navbar navbar-expand-sm navbar-light">
  	  <a class="navbar-brand" href="#" >
        <img src="../res/logo2.png" width="60" height="50" class="d-inline-block align-top" alt="">
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <!-- <li class="nav-item"><a class="nav-link" href="../profilePage/profilePage.html">Profile</a></li> -->
        </ul>
      </div>
      <form method="POST" action="finalLandingPage.php">
        <input type="submit" class="headerMenuLink d-inline-block border border-gray-dark rounded-1 px-2 py-1" name="log_out" value="Log Out">
      </form>
    </header>

  	<!-- <div class="container"> -->

        <div id="mySidebar" class="sidebar">
          <div class="nopadding" id = "sideWindow">
            <div class = "sideBar nopadding">
              <!-- ------------------------------Inside Side Bar Here Please-----------------------------------------  -->
              <a href="#" class="closebtn" id="openclose" onclick="openclose('none')">&gt;</a>
              <aside class="verticalNavBar">
                <ul class="tabs nopadding">
                  <!-- <li id="profileIcon"><a href="../profilePage/profilePage.html"><img class="icon nopadding" alt="account" src="../res/account.jpg"></a></li> -->
                  <li id="timeIcon"><img class="icon nopadding" alt="time" src="../res/clock.png"></li>
                  <li id="locationIcon"><img class="icon nopadding" alt="location" src="../res/ping.png"></li>
                  <li id="calendarIcon"><img class="icon nopadding" alt="calendar" src="../res/calendar.png"></li>
                </ul>
              </aside>


              <div class="notificationBar" id="notifContainer">
                <div class="notif-item notifs nopadding" id="notifBar">
                  Notifications
                </div>
              </div>
            </div>
            <div class="content" style="display: none" id="sideBarTimes">
              <table id="timesTable">
                <thead>
                  <tr>
                    <th>
                    <button class="timeButton" type="button" id="yesterdayTime">&lt;</button>
                    <h4 id="day">Sundays</h4>
                    <button class="timeButton" type="button" id="tomorrowTime">&gt;</button>
                  </th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td id="timepref_8">8:00 AM</td></tr>
                  <tr><td id="timepref_9">9:00 AM</td></tr>
                  <tr><td id="timepref_10">10:00 AM</td></tr>
                  <tr><td id="timepref_11">11:00 AM</td></tr>
                  <tr><td id="timepref_12">12:00 PM</td></tr>
                  <tr><td id="timepref_13">1:00 PM</td></tr>
                  <tr><td id="timepref_14">2:00 PM</td></tr>
                  <tr><td id="timepref_15">3:00 PM</td></tr>
                  <tr><td id="timepref_16">4:00 PM</td></tr>
                  <tr><td id="timepref_17">5:00 PM</td></tr>
                  <tr><td id="timepref_18">6:00 PM</td></tr>
                  <tr><td id="timepref_19">7:00 PM</td></tr>
                  <tr><td id="timepref_20">8:00 PM</td></tr>
                  <tr><td id="timepref_21">9:00 PM</td></tr>
                  <tr><td id="timepref_22">10:00 PM</td></tr>
                </tbody>
              </table>
            </div>
            <div class="content" style="display: none" id="sideBarLocs">
              <ol>
                <li><input type="text" class="locationSelector" id="locationOne" name="locationOne"></li>
                <li><input type="text" class="locationSelector" id="locationTwo" name="locationTwo"></li>
                <li><input type="text" class="locationSelector" id="locationThree" name="locationThree"></li>
                <li><input type="text" class="locationSelector" id="locationFour" name="locationFour"></li>
                <li><input type="text" class="locationSelector" id="locationFive" name="locationFive"></li>
              </ol>
              <input type="submit" id="addLocation" name="addLocation" value="Add Locations">
            </div>
            <div class="content" style="display: none" id="sideBarRequest">
              <select name="meeting_location" id="locationSelect">
                <?php
                  $topLocations = getTopLocations();
                  foreach($topLocations as $locations=>$ranks) {
                      echo "<option value = '" . $locations . "'>" . $locations . "</option>";
                  }
                ?>
              </select>
              <select name="meeting_time" id="timeSelect">
                <?php
                  $topTimes = getTopTimes();
                  foreach($topTimes as $times) {
                      echo "<option value = 'day=" . $times["day"] . "&time=" . $times["time"] . "'>" . $times["day"] . " " . $times["time"] . "</option>";
                  }
                ?>
              </select>
                <br><br>
                
              <input type="submit" id="requestMeeting" name="requestMeeting" value="Request Meeting">
              </div>
          </div>
        </div>

        <div id = "main">
          <div class= "chatBox">
            <?php
            foreach($message_data as $m) {
              echo "<div class='message'>" . $m["name"] . ": " . $m["message"] . "</div>";
            }
            ?>
            <!-- ------------------------------Insert Chat Menu Here Please-----------------------------------------  -->
          </div>
          <div class = "messageBox nopadding">
              <textarea id = "userMessage" placeholder = "Type your message here" cols = "100" rows = "3"></textarea>

              <button id = "messageSend">Send</button>
          </div>
        </div>

    <!-- </div> -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="../HomePage/homePage.js"></script>
  </body>
</html>
