<?php

function addGroup($group_name) {
    $new_id = bin2hex(random_bytes(12));
    $chat_file = CHAT_PATH . $new_id . ".txt";
    $fp = fopen($chat_file, "w");
    // fwrite($fp, "user_id,timestamp,text\n");
    fclose($fp);
    // $group_name is raw user input right now
    // There is no need for anything other than alphanumeric characters probably
    // So this is guarenteed not to be a CLI (I hope)
    if(!ctype_alnum(str_replace(" ", "", $group_name))) {
        echo "ERROR: Group name is not alphanumeric<br>";
        // We don't log a security error since this can be a common mistake
        return false;
    }
    $sql = "INSERT INTO groups (group_id, group_name, chat_history) VALUES ('$new_id', '$group_name', '$chat_file');";
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