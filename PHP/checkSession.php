<?php 

function checkSession() {
    if ($_SESSION["user_id"] != NULL && $_SESSION["group_id"] != NULL && !checkLastUpdate()) {
        return true;
    } else {
        return false;
    }
}

?>