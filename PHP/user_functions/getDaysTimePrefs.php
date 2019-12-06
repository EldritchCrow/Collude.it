<?php

include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "GET"
    || !isset($_GET["p_day"])) {
    http_response_code(400);
    die();
}
echo json_encode(getPrefsByDay($_GET["p_day"]));
die();

?>