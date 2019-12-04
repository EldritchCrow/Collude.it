<?php 

if(!defined(MAIN_APP_RUN)) {
    http_response_code(404);
    die();
}

function checkSession() {
    if ($_SESSION["user_id"] != NULL && $_SESSION["group_id"] != NULL && !checkLastUpdate()) {
        return true;
    } else {
        return false;
    }
}

?>