<?php

include_once("../library.php");

if($_SERVER["REQUEST_METHOD"] != "POST"
    || !isset($_POST["locationOne"])
    || !isset($_POST["locationTwo"])
    || !isset($_POST["locationThree"])
    || !isset($_POST["locationFour"])
    || !isset($_POST["locationFive"])) {
    http_response_code(400);
    die();
}

$preferences = array(new LocPreference($_POST["locationOne"], 1),
                    new LocPreference($_POST["locationTwo"], 2), 
                    new LocPreference($_POST["locationThree"], 3),
                    new LocPreference($_POST["locationFour"], 4),
                    new LocPreference($_POST["locationFive"], 5));
echo json_encode(addLocationPreferences($preferences));

?>