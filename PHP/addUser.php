<?php

function addUser($username, $real_name, $password) {
    $conn = Database::getConnection();
    $sql = "SELECT username FROM users WHERE username = '" . $username . "' LIMIT 1;";
    if($result = mysqli_query($conn, $sql)){
    
        if (mysqli_num_rows($result) == 1) {
            return array("success" => false,
                        "message" => "User already exists");
        }
        else {
            $sql = "INSERT INTO users (user_id, username, real_name, password_hash, last_update)";
            $new_id = bin2hex(random_bytes(12));
            $sql .= "VALUES ('"
                . $new_id . "', '"
                . $username . "', '"
                . $real_name . "', '"
                . password_hash($password, PASSWORD_BCRYPT) . "', '"
                . (new DateTime('now'))->format("Y-m-d H:i:s") . "');";
            if($result = mysqli_query($conn, $sql)){
                return array("success" => true,
                            "message" => "Successfully added user",
                            "user_id" => $new_id);
            } else {
                return array("success" => false,
                            "message" => "Failed to add user");
            }
        }
    } else {
        return array("success" => false,
                    "message" => "Failed to check if user exists");
    }
}

?>