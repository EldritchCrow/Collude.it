<?php
    function addLocationPreferences($location_list) {
        $conn = Database::getConnection();
        if (checkSession()) {
            foreach($location_list as $value) {
                $location_name = $value->location_name;
                $ranking = $value->ranking;
                $sql = "INSERT INTO location_prefs (user_id, loc, rank)";
                $sql.= " VALUES ('" . $_SESSION["user_id"] . "', '"
                . $location_name . "', '"
                . $ranking . "');";
                if ($result = mysqli_query($conn, $sql)) {
                    echo "Successfully added location preferences";
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