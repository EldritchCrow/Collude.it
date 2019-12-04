<?php

function logout_User() {
    session_unset();
    session_destroy();
    return array("success" => true,
                    "message" => "Successfully logged out");
}

// Called by AJAX
if(!defined("MAIN_APP_RUN")) {
    if($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(400);
        die();
    }
    echo json_encode(logout_User());
    die();
}

?>