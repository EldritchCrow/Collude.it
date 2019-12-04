<?php

include_once("security.php");
function sendMessage($message) {
    if(!validateInput($message)) {
        return array("success" => false,
                    "message" => "One of the inputs did not validate");
    }
    if(checkSession()) {
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
    $message = str_replace("<", "&gt", $message);
    $message = str_replace(">", "&lt", $message);
    // Not sure how this is possible, but whatever
    $message = str_replace("\n", " ", $message);
    if(!file_exists(CHAT_PATH . $g_id . ".txt")) {
        return array("success" => false,
                    "message" => "Could not find group chat file for group id " . $g_id);
    }
    $fp = fopen(CHAT_PATH . $g_id . ".txt", "a");
    $dat = array();
    $dat["user_id"] = $u_id;
    $dat["message"] = $message;
    fwrite($fp, json_encode($dat) . "\n");
    fclose($fp);
    return array("success" => true,
                "message" => "Sent message");
}

// Called by AJAX
if(!defined("MAIN_APP_RUN")) {
    if($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["message"])) {
        http_response_code(400);
        die();
    }
    echo json_encode(sendMessage($_POST["message"]));
    die();
}

?>