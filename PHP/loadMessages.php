<?php

include_once("reportSecurityError.php");
function loadMessages() {
    if(!isset($_SESSION["group_id"]) || !$_SESSION["user_id"]) {
        echo "ERROR: Tried to load messages but no session has been initiated";
        return false;
    }
    $g_id = $_SESSION["group_id"];
    if(!file_exists(CHAT_PATH . $g_id . ".txt")) {
        echo "ERROR: Could not find group chat file for group id " . $g_id . "<br>";
        return false;
    }
    // Extra security check
    // This should not be possible based off of how group IDs are handled
    // Regardless, user input tangentially touches this field and it's passed into a shell script
    // So we validate it to only be hex characters so it can not be used for a CLI
    if(!ctype_xdigit($g_id)) {
        echo "ERROR: group ID has non-hexidecimal characters";
        logSecurityMessage("CRITICAL: A group ID does not have only hexidecimal characters. This is probably due to a security vulnerability. Group ID found:\n" . $g_id . "\nUser that made the request:\n" . $_SESSION["user_id"]);
        return false;
    }
    // Doing things this way is for simplicity, but I think it is reasonably secure given the previous check
    $chat_loc = CHAT_PATH . $g_id . ".txt";
    //$file_data = `tail -n 200 $chat_loc`;
    $_ = fopen($chat_loc, "r");
    $file_data = explode("\n", fread($_, 10000000));
    fclose($_);
    $results = "";
    echo "File data:<br>";
    print_r($file_data);
    foreach($file_data as $line) {
        if($line == "") {
            continue;
        }
        $dat = json_decode($line,true);
        $results .= $dat["user_id"] . ": " . $dat["message"] . "<br>";
    }
    return $results;
}

?>