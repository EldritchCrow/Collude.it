<?php

include_once("security.php");
function voteMeeting($meeting_id, $vote) {
    if(!validateInput($meeting_id)
        || !validateInput($vote)) {
        return array("success" => false,
                    "message" => "One of the inputs did not validate");
    }
    $conn = Database::getConnection();
    if (checkSession()) {
        $sql = "INSERT INTO votes (user_id, meeting_id, yes)
                VALUES ('"
                    . $_SESSION["user_id"]
                    . "', '" . $meeting_id
                    . "', " . $vote . ")" . "
                ON DUPLICATE KEY UPDATE " .
                "user_id='". $_SESSION["user_id"] . "', " .
                "meeting_id='" . $meeting_id . "', " .
                "yes=" . $vote . ";";
        if ($result = mysqli_query($conn, $sql)) {
            if($vote == 0) {
                return array("success" => true,
                            "message" => "Successfully added vote");
            }
            $sql = "SELECT
                        COUNT(DISTINCT group_members.user_id) as pop,
                        SUM(IFNULL(votes.yes, 0)) as yes
                    FROM meetings
                    JOIN group_members
                        ON meetings.group_id=group_members.group_id
                    LEFT JOIN votes
                        ON votes.meeting_id=meetings.meeting_id
                    WHERE meetings.meeting_id='" . $meeting_id . "';";
            if($result = mysqli_query($conn, $sql)) {
                $row = $result->fetch_assoc();
                if ($row["yes"] >= ($row["pop"]*2/3)) {
                    $sql = "UPDATE meetings SET confirmed = 1 WHERE meeting_id = '" . $meeting_id . "';";
                    $_ = mysqli_query($conn, $sql);
                    return array("success" => true,
                                "message" => "Successfully added vote");
                }
            } else {
                return array("success" => true,
                            "message" => "Failed confirmation checking");
            }
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

?>