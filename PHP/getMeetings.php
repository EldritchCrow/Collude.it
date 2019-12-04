<?php

function getMeetings($confirmation) {
    if(!validateInput($confirmation)) {
        return array("success" => false,
                    "message" => "One of the inputs did not validate");
    }
    if (checkSession()) {
        $conn = Database::getConnection();
        $sql = "SELECT m_time, m_location FROM meetings WHERE confirmed = " . $confirmation . " AND group_id = '"
        . $_SESSION["group_id"] . "';";
        if ($result = mysqli_query($conn, $sql)) {
            $meetings = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $_ = array("m_time" => $row["m_time"],
                                "m_location" => $row["m_location"]);
                    $meetings = array_push($meetings, $_);
                }
            }
            return array("success" => true,
                        "message" => "Meetings retrieved",
                        "data" => $meetings);
        } else {
            return array("success" => false,
                        "message" => "Failed to load meetings");
        }  
    } else {
        return array("success" => false,
                    "message" => "Session has not been created");
    }
}

// Called by AJAX
if(!defined(MAIN_APP_RUN)) {
}

?>