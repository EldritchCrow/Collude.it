<?php 
function checkSession() {
    if ($_SESSION["user_id"] != NULL && $_SESSION["group_id"] != NULL) {
        return true;
    } else {
        return false;
    }
}

?>