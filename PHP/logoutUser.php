<?php

function logout_User() {
    session_unset();
    session_destroy();
}

?>