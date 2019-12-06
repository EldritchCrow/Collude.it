<?php

class LocPreference {
    public $location_name;
    public $ranking;

    function __construct($location, $rank) {
        $this->location_name = $location;
        $this->ranking = $rank;
    }
}

function addLocationPreferences($location_list) {
    $conn = Database::getConnection();
    if (checkSession()) {
        $u_id = $_SESSION["user_id"];
        $del = "DELETE FROM location_prefs WHERE user_id='$u_id'";
        if(!mysqli_query($conn, $del)) {
            return array("success" => false,
                        "message" => "Could not remove previous location preferences");
        }
        $failed = array();
        foreach($location_list as $value) {
            $location_name = $value->location_name;
            $ranking = $value->ranking;
            if(!validateInput($location_name)
                || !validateInput($ranking . "")) {
                    logSecurityMessage("One of " . $_SESSION["user_id"] . "'s location prefs did not validate");
                    continue;
                }
            $sql = "INSERT INTO location_prefs (user_id, loc, rank)";
            $sql.= " VALUES ('" . $u_id . "', '"
            . $location_name . "', '"
            . $ranking . "');";
            if ($result = mysqli_query($conn, $sql)) {
                //echo "Preference added <br>";
            } else {
                array_push($failed, $location_name);
            }
        }
        if(sizeof($failed) != 0) {
            return array("success" => false,
                        "message" => "One or more of the location preferences failed to update",
                        "details" => $failed);
        }
        return array("success" => true,
                    "message" => "Successfully added location preferences");
    } else {
        return array("success" => false,
                    "message" => "Session not created");
    }
}

function getLocPrefs() {
    if (!checkSession()) {
        return array("success" => false,
                    "message" => "Session not created");
    }
    $conn = Database::getConnection();
    $sql = "SELECT loc, rank
                FROM location_prefs
                WHERE user_id='" . $_SESSION["user_id"]
                . "' ORDER BY rank;";
    $result = mysqli_query($conn, $sql);
    if(!$result) {
        return array("success" => false,
                    "message" => "Could not retrieve information from database",
                    "sql_error" => mysqli_error($conn));
    }
    $ret = array();
    while ($row = $result->fetch_assoc()) {
        $_ = array("loc" => $row["loc"],
                    "rank" => $row["rank"]);
        array_push($ret, $_);
    }
    return array("success" => true,
                "message" => "Successfully retrieved user preference information",
                "data" => $ret);
}

?>