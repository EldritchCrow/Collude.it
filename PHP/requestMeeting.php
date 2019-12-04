<?php
    function requestMeeting($meeting_time, $meeting_location) {
        $conn = Database::getConnection();
        if (checkSession()) {
            $meeting_id = bin2hex(random_bytes(12));
            $sql = "INSERT INTO meetings (meeting_id, group_id, m_time, m_location, confirmed)";
            $sql .= "VALUES ('" . $meeting_id . "', '"
            . $_SESSION["group_id"] . "', '"
            . $meeting_time . "', '"
            . $meeting_location . "', "
            . 0 . ");";
            if($result = mysqli_query($conn, $sql)){
                echo "Successfully added meeting<br>";
            } else {
                echo "Something fucked up:<br>" . mysqli_error($conn) . "<br>";
            }
            return true;
        }
        else {
            echo "Session not created";
            return false;
        }

    }
?>