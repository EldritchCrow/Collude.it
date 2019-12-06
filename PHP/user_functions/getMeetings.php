<?php
include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "GET" || !isset($_GET["confirmed"])) {
    http_response_code(400);
    die();
}
echo json_encode(getMeetings($_GET["confirmed"]));
die();
?>