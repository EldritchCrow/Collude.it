<?php

function logoutUser() {
    session_unset();
    session_destroy();
    return array("success" => true,
                    "message" => "Successfully logged out");
}

?>