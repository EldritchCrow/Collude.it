<?php
include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "POST"
    || !isset($_POST["m_time"])
    || !isset($_POST["m_loc"])) {
    http_response_code(400);
    die();
}
header('Content-type: application/json');
echo json_encode(requestMeeting($_POST["m_time"], $_POST["m_loc"]));
die();
?>