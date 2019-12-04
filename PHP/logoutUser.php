<?php

function logout_User() {
    session_unset();
    session_destroy();
}

// Called by AJAX
if(!defined(MAIN_APP_RUN)) {
}

?>