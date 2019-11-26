<?php
    function loginUser($username, $password) {
        $sql = "SELECT users.password_hash, users.user_id, groupMembers.group_id FROM users WHERE username = '" . $username "' INNER JOIN groupMembers ON users.user_id = groupMembers.user_id LIMIT 1;";
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            $row = mysql_fetch_row($result);
            if (password_verify($password, $row[0]))
                session_start();
                $_SESSION["user_id"] = $row[1];
                $_SESSION["group_id"] = $row[2];
                return true;
            }
        }
        return false;
    }
?>