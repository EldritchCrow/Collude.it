<?php
include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["message"])) {
    http_response_code(400);
    die();
}
header('Content-type: application/json');
echo json_encode(sendMessage($_POST["message"]));
die();
?>