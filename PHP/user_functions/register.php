<?php
include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "POST"
    || !isset($_POST["username"])
    || !isset($_POST["real_name"])
    || !isset($_POST["password"])
    || !isset($_POST["group_name"])
    || !isset($_POST["group_id"])) {
    http_response_code(400);
    die();
}
header('Content-type: application/json');
echo json_encode(
    registerUser(
        $_POST["username"],
        $_POST["real_name"],
        $_POST["password"],
        $_POST["group_name"],
        $_POST["group_id"]));
die();
?>