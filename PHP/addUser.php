<?php
function addUser($username, $real_name, $password) {
    $sql = "SELECT username FROM users WHERE username = " . $username " LIMIT 1;";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        return false;
    }
    else {
        $sql = "INSERT INTO users (user_id, username, real_name, password_hash, last_update)";
        $sql .= "VALUES ('" . bin2hex(random_bytes(12)) . "', '" . $username . "', '" . $real_name "', '" . password_hash($password, PASSWORD_BCRYPT) . "', '" . new DateTime('now') . "');";
        return true;
    }
}

?>