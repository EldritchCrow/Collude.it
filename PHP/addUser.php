<?php
function addUser($username, $real_name, $password) {
    $conn = Database::getConnection();
    $sql = "SELECT username FROM users WHERE username = '" . $username . "' LIMIT 1;";
    if($result = mysqli_query($conn, $sql)){
    
        if (mysqli_num_rows($result) == 1) {
            return false;
        }
        else {
            $sql = "INSERT INTO users (user_id, username, real_name, password_hash, last_update)";
            $sql .= "VALUES ('"
                . bin2hex(random_bytes(12)) . "', '"
                . $username . "', '"
                . $real_name . "', '"
                . password_hash($password, PASSWORD_BCRYPT) . "', '"
                . (new DateTime('now'))->format("Y-m-d H:i:s") . "');";
            if($result = mysqli_query($conn, $sql)){
                echo "Successfully added user<br>";
            } else {
                echo "Something fucked up:<br>" . mysqli_error($conn) . "<br>";
            }
            return true;
        }
    } else {
        echo "Something fucked up:<br>" . mysqli_error($conn) . "<br>";
    }
}
?>