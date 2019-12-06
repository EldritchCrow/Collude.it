<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'addGroup.php';
require_once 'addGroupMembership.php';
require_once 'addLocationPreferences.php';
require_once 'addTimePreferences.php';
require_once 'addUser.php';
require_once 'checkLastUpdate.php';
require_once 'checkSession.php';
require_once 'databaseConnect.php';
require_once 'getMeetings.php';
require_once 'getTopLocations.php';
require_once 'getTopTimes.php';
require_once 'loadMessages.php';
require_once 'loginUser.php';
require_once 'logoutUser.php';
require_once 'registerUser.php';
require_once 'requestMeeting.php';
require_once 'security.php';
require_once 'sendMessage.php';
require_once 'voteMeeting.php';

define("CHAT_PATH", "../chats/");

function getChatsPath() {
    //print_r(scandir("."));
    if(defined("MAIN_APP_RUN")) {
        return CHAT_PATH;
    } else {
        return "../" . CHAT_PATH;
    }
}

?>
