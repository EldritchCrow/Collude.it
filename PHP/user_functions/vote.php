<?php
include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "POST"
    || !isset($_POST["meeting_id"])
    || !isset($_POST["vote"])) {
    http_response_code(400);
    die();
}
echo json_encode(voteMeeting($_POST["meeting_id"], $_POST["vote"]));
die();
?>