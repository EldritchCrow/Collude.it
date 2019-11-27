<?php

function addGroup($group_name) {
    $new_id = bin2hex(random_bytes(12));
    $chat_file = "chats/" . $new_id . ".txt";
    $fp = fopen($chat_file, "w");
    fwrite($fp, "user_id,timestamp,text\n");
    $sql = "INSERT INTO groups (group_id, group_name, chat_history) VALUES ($new_id, $group_name, $chat_file);";
    $conn = Database::getConnection();
    if(mysqli_query($conn, $sql)) {
        echo "Successfully added $group_name to the groups database";
        return $new_id;
    } else {
        echo "Could not add group to groups database<br>";
        return false;
    }
}

?>