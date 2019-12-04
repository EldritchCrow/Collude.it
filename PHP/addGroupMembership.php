<?php

if(!defined(MAIN_APP_RUN)) {
    http_response_code(404);
    die();
}

function addGroupMember($group_id, $user_id) {
    $sql = "INSERT INTO group_members (group_id, user_id) VALUES ('$group_id', '$user_id');";
    $conn = Database::getConnection();
    if(mysqli_query($conn, $sql)) {
        return array("success" => true,
                    "message" => "Successfully added a user-group pair to the membership database");
    } else {
        return array("success" => false,
                    "message" => "Could not add group membership to database");
    }
}

?>