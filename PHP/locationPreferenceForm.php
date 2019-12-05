<?php

class Preference {
    public $location_name;
    public $ranking;

    function __construct($location, $rank) {
        $this->location = $location;
        $this->rank = $rank;
    }
}

if (isset($_POST["addLocation"])) {
    $preferences = array(new Preference($_POST["locationOne"], 1), new Preference($_POST["locationTwo"], 2), 
    new Preference($_POST["locationThree"], 3), new Preference($_POST["locationFour"], 4), new Preference($_POST["locationFive"], 5));
    addLocationPreferences($preferences);
}


?>

<!DOCTYPE html>

<head>
    <Title>Test page</Title>
</head>

<form method="POST" action="locationPreferenceForm.php">
    <ol>
        <li><input type="text" name="locationOne" ></li>
        <li><input type="text" name="locationTwo" ></li>
        <li><input type="text" name="locationThree" ></li>
        <li><input type="text" name="locationFour" ></li>
        <li><input type="text" name="locationFive" ></li>
    </ol>
    <input type="submit" name="addLocation" value="Add Locations">
</form>

</html>