<?php

function registerUser($username, $real_name, $password, $group_name = "", $group_id = "") {
    if($group_id == "" && $group_name == "") {
        echo "ERROR: Must have either group_name or group_id provided to register";
    }

    $user_id = addUser($username, $real_name, $password);
    if(!$user_id) {
        echo "Error adding user to the database";
        return false;
    }

    if($group_id == "") {
        $group_id = addGroup($group_name);
    }

    if(!$group_id) {
        echo "ERROR: Failed to create a group_id or one was not provided";
        return false;
    }
    
    if(addGroupMember($group_id, $user_id)) {
        echo "Successfully registered new user<br>";
        return true;
    } else {
        echo "ERROR: Failed to add group membership<br>";
        return false;
    }
}

?>