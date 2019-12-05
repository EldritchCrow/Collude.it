<?php



if (isset($_POST["request_meeting"])) {
    requestMeeting($_POST["meeting_time"], $_POST["meeting_location"]);
?>


<!DOCTYPE html>

<head>
    <Title>Test page</Title>
</head>

<form method="POST" action="meetingForm.php">
    <select name="meeting_time">
        <?php
            $topLocations = getTopLocations();
            foreach($topLocations as $locations) {
                echo "<option value = '" . $locations . "'>" . $locations . "</option>"
            }
        ?>
    </select>
    <select name="meeting_location">
        <?php
            $topTimes = getTopTimes();
            foreach($topTimes as $times) {
                echo "<option value = '" . $times . "'>" . $times . "</option>"
            }
        ?>
    </select>
    <br><br>
    
    <input tpe="request_meeting"
</form>
</form>

</html>