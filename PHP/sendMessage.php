<?php

require_once("library.php");
function sendMessage($message) {
    if(strlen($message) > 1000) {
        $message = substr($message, 0, 2000) . "-";
    }
    if(!checkSession()) {
        return array("success" => false,
                    "message" => "Session not created");
    }
    $g_id = $_SESSION["group_id"];
    $u_id = $_SESSION["user_id"];
    if(strpos($message, "<script")) {
        logSecurityMessage("WARNING: User " . $u_id . " probably tried to put executable Javascript into a message.");
    }
    // Preventing XSS attacks
    // Stops user messages from becoming arbitrarily executable JS
    $message = str_replace("&", "&amp", $message);
    $message = str_replace("<", "&lt", $message);
    $message = str_replace(">", "&gt", $message);
    // Not sure how this is possible, but whatever
    $message = str_replace("\n", " ", $message);
    if(!file_exists(getChatsPath() . $g_id . ".txt")) {
        return array("success" => false,
                    "message" => "Could not find group chat file for group id " . $g_id,
                    "attempted" => getChatsPath() . $g_id . ".txt");
    }
    $fp = fopen(getChatsPath() . $g_id . ".txt", "a");
    $dat = array();
    $dat["user_id"] = $u_id;
    $dat["message"] = $message;
    fwrite($fp, json_encode($dat) . "\n");
    fclose($fp);
    return array("success" => true,
                "message" => "Sent message");
}

?>