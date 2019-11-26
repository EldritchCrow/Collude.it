<?php
    function loginUser($username, $password) {
        $sql = "SELECT username FROM users WHERE username = '" . $username "' LIMIT 1;";
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            $sql = "SELECT password_hash FROM users WHERE password_hash = '" . password_hash($password, PASSWORD_BCRYPT) . "' AND username = '" . $username ';";
            result = $conn->query($sql);
            if ($result->num_rows == 1) {
                return true;
            }
        }
        return false;
    }
?>