<?php

include_once("../library.php");

print_r($_POST);

if($_SERVER["REQUEST_METHOD"] != "POST"
    || !isset($_POST["locationOne"])
    || !isset($_POST["locationTwo"])
    || !isset($_POST["locationThree"])
    || !isset($_POST["locationFour"])
    || !isset($_POST["locationFive"])) {
    http_response_code(400);
    die();
}

class Preference {
    public $location_name;
    public $ranking;

    function __construct($location, $rank) {
        $this->location_name = $location;
        $this->ranking = $rank;
    }
}

if (isset($_POST["addLocation"])) {
    $preferences = array(new Preference($_POST["locationOne"], 1), new Preference($_POST["locationTwo"], 2), 
    new Preference($_POST["locationThree"], 3), new Preference($_POST["locationFour"], 4), new Preference($_POST["locationFive"], 5));
    addLocationPreferences($preferences);
}