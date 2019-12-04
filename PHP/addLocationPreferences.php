<?php

function addLocationPreferences($location_list) {
    $conn = Database::getConnection();
    if (checkSession()) {
        $failed = array();
        foreach($location_list as $value) {
            $location_name = $value->location_name;
            $ranking = $value->ranking;
            $sql = "INSERT INTO location_prefs (user_id, loc, rank)";
            $sql.= " VALUES ('" . $_SESSION["user_id"] . "', '"
            . $location_name . "', '"
            . $ranking . "');";
            if ($result = mysqli_query($conn, $sql)) {
                //echo "Preference added <br>";
            } else {
                $failed = array_push($failed, $location_name);
            }
        }
        if(sizeof($failed) != 0) {
            return json_encode(
                array("success" => false,
                        "message" => "One or more of the location preferences failed to update",
                        "details" => $failed)
                    );
        }
        return json_encode(
            array("success" => true,
                    "message" => "Successfully added location preferences")
                );
    } else {
        return json_encode(
            array("success" => false,
                    "message" => "Session not created")
                );
    }
}

?>