<?php

if(!defined(MAIN_APP_RUN)) {
    http_response_code(404);
    die();
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'databaseConnect.php';
require_once 'addLocationPreferences.php';
require_once 'addTimePreferences.php';
require_once 'addUser.php';
require_once 'addGroup.php';
require_once 'addGroupMembership.php';
require_once 'checkLastUpdate.php';
require_once 'getMeetings.php';
require_once 'loadMessages.php';
require_once 'loginUser.php';
require_once 'logoutUser.php';
require_once 'requestMeeting.php';
require_once 'sendMessage.php';
require_once 'registerUser.php';
require_once 'checkSession.php';
require_once 'reportSecurityError.php';
define("CHAT_PATH", "../chats/");

?>
