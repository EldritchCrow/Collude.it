<?php

function voteMeeting($meeting_id, $vote) {
    if(!validateInput($meeting_id)
        || !validateInput($vote)) {
        return array("success" => false,
                    "message" => "One of the inputs did not validate");
    }
    $conn = Database::getConnection();
    if (checkSession()) {
        $sql = "INSERT INTO votes (user_id, meeting_id, yes)";
        $sql.= "VALUES ('" . $_SESSION["user_id"] . "', '"
        . $meeting_id . "', "
        . $vote . ");";
        if ($result = mysqli_query($conn, $sql)) {
            $sql = "SELECT group_id FROM meetings WHERE meeting_id = '" . $meeting_id . "';";
            $group_id = mysqli_query($conn, $sql);
            $sql = "SELECT COUNT(user_id) FROM group_members WHERE group_id = '" . $group_id . "';";
            $group_count = mysqli_query($conn, $sql);
            $sql = "SELECT COUNT(user_id) FROM votes WHERE meeting_id = '" . $meeting_id . "' AND yes = 1;";
            $yes_count = mysqli_query($conn, $sql);
            if (($group_count*2/3) < $yes_count) {
                $sql = "UPDATE meetings SET confirmed = 1 WHERE meeting_id = '" . $meeting_id . "';";
            }
            return array("success" => true,
                        "message" => "Successfully added voted");
        } else {
            return array("success" => false,
                        "message" => "Failed vote registration");
        }
        return true;
    } else {
        return array("success" => false,
                    "message" => "Session not created");
    }
}

// Called by AJAX
if(!defined(MAIN_APP_RUN)) {
}

?>