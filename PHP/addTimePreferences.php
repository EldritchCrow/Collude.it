<?php
    function addTimePreferences($time_list) {
        $conn = Database::getConnection();
        if (checkSession()) {
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
                    echo "Successfully added time preferences";
                } else {
                    echo "Something fucked up: <br>" . mysqli_error($conn) . "<br>";
                }
            } 
            return true;
        } else {
            echo "Session not created <br>";
            return false;
        }
    }
?>