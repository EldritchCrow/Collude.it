<?php
include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(400);
    die();
}
echo json_encode(logoutUser());
die();
?>