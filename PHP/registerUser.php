<?php

function registerUser($username, $real_name, $password, $group_name = "", $group_id = "") {
    if($group_id == "" && $group_name == "") {
        return json_encode(
            array("success" => false,
                    "message" => "Must have either group_name or group_id provided to register")
                );
    }

    $user_id = addUser($username, $real_name, $password);
    if(!$user_id) {
        return json_encode(
            array("success" => false,
                    "message" => "Error adding user to the database")
                );
    }

    if($group_id == "") {
        $group_id = addGroup($group_name);
    }

    if(!$group_id) {
        return json_encode(
            array("success" => false,
                    "message" => "Failed to create a group_id or one was not provided")
                );
    }
    
    if(addGroupMember($group_id, $user_id)) {
        return json_encode(
            array("success" => true,
                    "message" => "Successfully registered new user")
                );
    } else {
        return json_encode(
            array("success" => false,
                    "message" => "Failed to add group membership")
                );
    }
}

?>