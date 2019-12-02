<?php
include_once("reportSecurityError.php");
function sendMessage($message) {
    if(!isset($_SESSION["group_id"]) || !$_SESSION["user_id"]) {
        echo "ERROR: Tried to send a message but no session has been initiated";
        return false;
    }
    $g_id = $_SESSION["group_id"];
    $u_id = $_SESSION["user_id"];
    if(strpos($message, "<script")) {
        logSecurityMessage("WARNING: User " . $u_id . " probably tried to put executable Javascript into a message.");
    }
    // Preventing XSS attacks
    // Stops user messages from becoming arbitrarily executable JS
    $message = str_replace("&", "&amp", $message);
    $message = str_replace("<", "&gt", $message);
    $message = str_replace(">", "&lt", $message);
    // Not sure how this is possible, but whatever
    $message = str_replace("\n", " ", $message);
    if(!file_exists(CHAT_PATH . $g_id . ".txt")) {
        echo "ERROR: Could not find group chat file for group id " . $g_id . "<br>";
        return false;
    }
    $fp = fopen(CHAT_PATH . $g_id . ".txt", "a");
    $dat = array();
    $dat["user_id"] = $u_id;
    $dat["message"] = $message;
    fwrite($fp, json_encode($dat) . "\n");
    fclose($fp);
    return true;
}
?>