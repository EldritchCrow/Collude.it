<?php

if(!defined("MAIN_APP_RUN")) {
    http_response_code(404);
    die();
}

function addGroup($group_name) {
    $new_id = bin2hex(random_bytes(12));
    $chat_file = CHAT_PATH . $new_id . ".txt";
    $fp = fopen($chat_file, "w");
    // fwrite($fp, "user_id,timestamp,text\n");
    fclose($fp);
    $sql = "INSERT INTO groups (group_id, group_name, chat_history) VALUES ('$new_id', '$group_name', '$chat_file');";
    $conn = Database::getConnection();
    if(mysqli_query($conn, $sql)) {
        return array("success" => true,
                    "message" => "Successfully added $group_name to the groups database",
                    "group_id" => $new_id);
    } else {
        return array("success" => false,
                    "message" => "Could not add group to groups database");
    }
}

?>