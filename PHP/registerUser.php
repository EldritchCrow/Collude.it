<?php

include_once("security.php");
function registerUser($username, $real_name, $password, $group_name = "", $group_id = "") {
    if(!validateInput($username)
        || !validateInput($real_name)
        || !validateInput($password)
        || ! (validateInput($group_name) || validateInput($group_id))
        || strlen($password) < 12) {
        return array("success" => false,
                    "message" => "One of the registration inputs did not validate");
    }

    if  (strlen($username) > 32) {
        return array("success" => false,
        "message" => "Username is too long");
    }

    $successful = addUser($username, $real_name, $password);
    if(!$successful["success"]) {
        return array("success" => false,
                    "message" => $successful["message"]);
    } else {
        $user_id = $successful["user_id"];
    }

    if(!$user_id) {
        return array("success" => false,
                    "message" => "Error adding user to the database");
    }

    if(validateInput($group_name)) {
        $successful = addGroup($group_name);
        if (!$successful["success"]) {
            return array("success" => false,
                    "message" => $successful["message"]);
        } else {
            $group_id = $successful["group_id"];
        }
    }

    if(!validateInput($group_id)) {
        return array("success" => false,
                    "message" => "Failed to create a group_id or a valid one was not provided");
    }
    
    $successful = addGroupMember($group_id, $user_id);
    if(!$successful["success"]) {
        return array("success" => false,
                    "message" => $successful["message"]);
    } else {
        
        return array("success" => true,
            "message" => "Successfully registered new user");
    }
}

?>