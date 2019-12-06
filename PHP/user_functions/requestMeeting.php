<?php
include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "POST"
    || !isset($_POST["meeting_time"])
    || !isset($_POST["meeting_location"])) {
    http_response_code(400);
    die();
}

header('Content-type: application/json');

parse_str($_POST["meeting_time"]);
$time_int = strtotime("next " . $day) + (36*$time) + 6*3600;

echo json_encode(requestMeeting($time_int, $_POST["meeting_location"]));
die();
?>