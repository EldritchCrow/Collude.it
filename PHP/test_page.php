<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("library.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    echo "<br>";
}
print_r($_SESSION);
echo "<br>";
$message_data = false;
if (isset($_POST["add_user"])) {
    echo registerUser($_POST["username"], $_POST["real_name"], $_POST["password"], $_POST["group_name"], $_POST["group_id"]);
} elseif (isset($_POST["login"])) {
    echo loginUser($_POST["username"], $_POST["password"]);
} elseif (isset($_POST["send_message"])) {
    echo sendMessage($_POST["chat_info"]);
} elseif (isset($_POST["load_messages"])) {
    $message_data = loadMessages();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Test page</title>
</head>

<body>
    Register User:<br>
    <form method="POST" action="test_page.php">
        <input type="text" name="username">
        <input type="text" name="real_name">
        <input type="text" name="password">
        <input type="text" name="group_id">
        <input type="text" name="group_name">
        <input type="submit" name="add_user" value="Submit">
    </form>
    <br>
    Login:<br>
    <form method="POST" action="test_page.php">
        <input type="text" name="username">
        <input type="text" name="password">
        <input type="submit" name="login" value="Submit">
    </form>
    Send Message:<br>
    <form method="POST" action="test_page.php">
        <input type="text" name="chat_info">
        <input type="submit" name="send_message" value="Send">
    </form>
    Load Messages:<br>
    <form method="POST" action="test_page.php">
        <input type="submit" name="load_messages" value="Load">
    </form>
    Message data:
    <div id="messages">
        <?php
        if($message_data != false) {
            echo $message_data;
        }
        ?>
    </div>
</body>

</html>