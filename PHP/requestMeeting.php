<?php

include_once("security.php");
function requestMeeting($meeting_time, $meeting_location) {
    if(!validateInput($meeting_time."")
        || !validateInput($meeting_location)) {
        return array("success" => false,
                    "message" => "One of the inputs did not validate");
    }
    $conn = Database::getConnection();
    if (checkSession()) {
        $meeting_id = bin2hex(random_bytes(12));
        $sql = "SELECT UNIX_TIMESTAMP(m_time) as m_time, m_location
                    FROM meetings
                    WHERE group_id='" . $_SESSION["group_id"] . "';";
        if($result = mysqli_query($conn, $sql)){
            while($row = $result->fetch_assoc()) {
                if($row["m_time"] == $meeting_time && $row["m_location"] == $meeting_location) {
                    return array("success" => true,
                                "message" => "Meeting is already in the database");
                }
            }
        } else {
            return array("success" => false,
                        "message" => "Could not retrieve existing meetings");
        }
        $sql = "INSERT INTO meetings (meeting_id, group_id, m_time, m_location, confirmed)";
        $sql .= "VALUES ('" . $meeting_id . "', '"
        . $_SESSION["group_id"] . "', FROM_UNIXTIME("
        . $meeting_time . "), '"
        . $meeting_location . "', "
        . 0 . ");";
        if($result = mysqli_query($conn, $sql)){
            return array("success" => true,
                        "message" => "Added meeting to database");
        }
        return array("success" => false,
                    "message" => "Failed to add meeting to database");
    }
    else {
        return array("success" => false,
                    "message" => "Session not created");
    }

}

?>