<?php

function checkSession() {
    if (isset($_SESSION["user_id"]) && isset($_SESSION["group_id"]) && checkLastUpdate()) {
        return true;
    } else {
        return false;
    }
}

?>