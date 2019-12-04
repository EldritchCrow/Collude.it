<?php

function loginUser($username, $password) {
    if(!validateInput($username)
        || !validateInput($password)) {
        return json_encode(
            array("success" => false,
                    "message" => "One of the inputs did not validate")
                );
    }
    $conn = Database::getConnection();
    $sql = "SELECT users.password_hash, users.user_id, group_members.group_id FROM users JOIN group_members ON users.user_id = group_members.user_id WHERE username = '"
        . $username
        . "'LIMIT 1;";
    if($result = mysqli_query($conn, $sql)){
    
        if (mysqli_num_rows($result) == 0) {
            return json_encode(
                array("success" => false,
                        "message" => "Username/Password combination not found")
                    );
        }
        $row = mysqli_fetch_row($result);
        if (password_verify($password, $row[0])) {
            $_SESSION["user_id"] = $row[1];
            $_SESSION["group_id"] = $row[2];
            return json_encode(
                array("success" => true,
                        "message" => "Successfully logged in")
                    );
        }
    }
    return json_encode(
        array("success" => false,
                "message" => "Failed to check database to log in")
            );
}

?>