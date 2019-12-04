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
            return json_encode(
                array("success" => true,
                        "message" => "Added meeting to database")
                    );
        }
        return json_encode(
            array("success" => false,
                    "message" => "Failed to add meeting to database")
                );
    }
    else {
        return json_encode(
            array("success" => false,
                    "message" => "Session not created")
                );
    }

}

?>