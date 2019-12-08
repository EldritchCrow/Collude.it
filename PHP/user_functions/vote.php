<?php
include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "POST"
    || !isset($_POST["meeting_id"])
    || !(isset($_POST["yes"]) || isset($_POST["no"]))) {
    http_response_code(400);
    die();
}
$vote = 0;
if($_POST["yes"]) {
    $vote = 1;
}
echo json_encode(voteMeeting($_POST["meeting_id"], $vote));
die();
?>