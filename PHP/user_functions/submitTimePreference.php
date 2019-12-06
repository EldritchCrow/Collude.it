<?php

include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "POST"
    || !isset($_POST["p_day"])
    || !isset($_POST["p_times"])) {
    http_response_code(400);
    die();
}
echo json_encode(addSingleDayPrefs($_POST["p_day"], $_POST["p_times"]));
die();

?>