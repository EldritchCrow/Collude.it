<?php

function addTimePreferences($time_list) {
    $conn = Database::getConnection();
    if (checkSession()) {
        $failed = array();
        foreach($time_list as $value) {
            $day = $value->day;
            $start_time = $value->start_time;
            $end_time = $value->end_time;
            $sql = "INSERT INTO datetime_prefs (user_id, day, start_time, end_time)";
            $sql.= " VALUES ('" . $_SESSION["user_id"] . "', '"
            . $day . "', '"
            . $start_time . "', '"
            . $end_time . "');";
            if ($result = mysqli_query($conn, $sql)) {
                // echo "Time preference added <br>";
            } else {
                $failed = array_push($failed, $day . " : " . $start_time . " - " . $end_time);
            }
        }
        if(sizeof($failed) != 0) {
            return array("success" => false,
                        "message" => "One or more of the time preferences failed to update",
                        "details" => $failed);
        }
        return array("success" => true,
                    "message" => "Successfully added time preferences");
    } else {
        return array("success" => false,
                    "message" => "Session not created");
    }
}

?>