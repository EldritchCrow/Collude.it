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

$firstLocation = new location();
$firstLocation->location_name = "Student Union";
$firstLocation->ranking = 2;

$secondLocation = new location();
$secondLocation->location_name = "Library";
$secondLocation->ranking = 1;

$locations = array($firstLocation, $secondLocation);

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
    </form>
</body>

</html>