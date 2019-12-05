<?php
include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "POST"
        || !isset($_POST["username"])
        || !isset($_POST["password"])) {
    http_response_code(400);
    die();
}
echo json_encode(loginUser($_POST["username"], $_POST["password"]));
die();
?>