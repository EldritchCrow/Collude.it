<?php

function loadMessages() {
    if(checkSession()) {
        return json_encode(
            array("success" => false,
                    "message" => "Session not created")
                );
    }
    $g_id = $_SESSION["group_id"];
    if(!file_exists(CHAT_PATH . $g_id . ".txt")) {
        return json_encode(
            array("success" => false,
                    "message" => "Could not find group chat file for group id " . $g_id)
                );
    }
    // Extra security check
    // This should not be possible based off of how group IDs are handled
    // Regardless, user input tangentially touches this field and it's passed into a shell script
    // So we validate it to only be hex characters so it can not be used for a CLI
    if(!ctype_xdigit($g_id)) {
        logSecurityMessage("CRITICAL: A group ID does not have only hexidecimal characters. This is probably due to a security vulnerability. Group ID found:\n" . $g_id . "\nUser that made the request:\n" . $_SESSION["user_id"]);
        return json_encode(
            array("success" => false,
                    "message" => "Group ID has non-hexidecimal characters")
                );
    }
    // Doing things this way is for simplicity, but I think it is reasonably secure given the previous check
    $chat_loc = CHAT_PATH . $g_id . ".txt";
    //$file_data = `tail -n 200 $chat_loc`;
    $_ = fopen($chat_loc, "r");
    $file_data = explode("\n", fread($_, 10000000));
    fclose($_);
    $results = "";
    foreach($file_data as $line) {
        if($line == "") {
            continue;
        }
        $dat = json_decode($line,true);
        $results .= $dat["user_id"] . ": " . $dat["message"] . "<br>";
    }
    return json_encode(
        array("success" => true,
                "message" => "Loaded messages",
                "data" => $results)
            );
}

?>