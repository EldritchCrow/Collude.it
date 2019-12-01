<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("library.php");
if($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    echo "<br>";
}
print_r($_SESSION);
echo "<br>";

class location {
    public $location_name;
    public $ranking;
}

class time {
    public $start_time;
    public $end_time;
    public $day;
}

$firstLocation = new location();
$firstLocation->location_name = "Student Union";
$firstLocation->ranking = 2;
$secondLocation = new location();
$secondLocation->location_name = "Library";
$secondLocation->ranking = 1;

$firstDay = new time();
$firstDay->start_time = 1200;
$firstDay->end_time = 1400;
$firstDay->day = "Monday";

$secondDay = new time();
$secondDay->start_time = 1300;
$secondDay->end_time = 1500;
$secondDay->day = "Tuesday";

$locations = array($firstLocation, $secondLocation);
$days = array($firstDay, $secondDay);

if(isset($_POST["add_user"])) {
    echo addUser($_POST["username"], $_POST["real_name"], $_POST["password"]);
} elseif (isset($_POST["login"])) {
    echo loginUser($_POST["username"], $_POST["password"]);
} else if (isset($_POST["request_meeting"])) {
    echo requestMeeting($_POST["meeting_time"], $_POST["meeting_location"]);
} else if (isset($_POST["get_meetings"])) {
    echo getMeetings();
} else if (isset($_POST["submitLocations"])) {
    echo addLocationPreferences($locations);
} else if (isset($_POST["submitTimes"])) {
    echo addTimePreferences($days);
}
echo "<br>";

?>

<!DOCTYPE html>
<html>

<head>
    <title>Test page</title>
</head>
<body>
    <form method="POST" action="test_page.php">
        <input type="text" name="username">
        <input type="text" name="real_name">
        <input type="text" name="password">
        <input type="submit" name="add_user" value="Submit">
    </form>
    <br>
    <form method="POST" action="test_page.php">
        <input type="text" name="username">
        <input type="text" name="password">
        <input type="submit" name="login" value="Submit">
    </form>

    <form method="POST" action="test_page.php">
        <input type="text" name="meeting_time">
        <input type="text" name="meeting_location">
        <input type="submit" name="request_meeting" value="Submit">
    </form>

    <form method="POST" action="test_page.php">
    <input type="submit" name="get_meetings" value="Submit">

    <input type="submit" name="submitLocations" value="Submit">
    <input type="submit" name="submitTimes" value="Submit">
    </form>
</body>

</html>