<?php
include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "GET") {
    http_response_code(400);
    die();
}
echo json_encode(loadMessages());
die();
?>