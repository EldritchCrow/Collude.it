<?php

function addGroupMember($group_id, $user_id) {
    $sql = "INSERT INTO group_members (group_id, user_id) VALUES ($group_id, $user_id);";
    $conn = Database::getConnection();
    if(mysqli_query($conn, $sql)) {
        echo "Successfully added a user-group pair to the membership database";
        return true;
    } else {
        echo "Could not add group to groups database<br>";
        return false;
    }
}

?>