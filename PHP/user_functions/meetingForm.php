<?php

class Database {

    private static $db;
    private $connection;

    private function __construct() {
        $this->connection = new MySQLi("localhost", "root", "password", "collude_it");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    function __destruct() {
        $this->connection->close();
    }

    public static function getConnection() {
        if (self::$db == null) {
            self::$db = new Database();
        }
        return self::$db->connection;
    }
}

$conn = $conn = Database::getConnection();

if (isset($_POST["request_meeting"])) {
    requestMeeting($_POST["meeting_time"], $_POST["meeting_location"]);
}

function getTopTime(&$times) {
    $maxWeekday;
    $maxWeektime = 0;

    $max = 0;

    foreach($times as $x=>$value) {
        for ($y = 0; $y < 48; $y++) {
            if ($max < $value[$y]) {
                $max = $value[$y];
                $maxWeekday = $x;
                $maxWeektime = $y;
                $times[$x] = $value;
            }
        }
    }
    $value = $times[$maxWeekday];
    for ($y = $maxWeektime; $y < $maxWeektime+4; $y++) {
        $times[$maxWeekday][$y] = 0;
    }

    $maxWeektime = ($maxWeektime+1)*50;
    if ($maxWeektime%100 == 50) {
        $maxWeektime -= 20;
    }

    return array("day" => $maxWeekday, "time" => $maxWeektime);
}


function getTopTimes() {
    $conn = Database::getConnection();
    $sql = "SELECT datetime_prefs.start_time, datetime_prefs.end_time, datetime_prefs.day
                FROM datetime_prefs
                JOIN group_members
                    ON group_members.user_id=datetime_prefs.user_id
                WHERE group_members.group_id ='f9cf65d737dc382b18f96ac9';";
    if ($result = mysqli_query($conn, $sql)) {
        if ($result->num_rows > 0) {
            $times = array( "Monday"=>array_fill(0, 48, 0), "Tuesday"=>array_fill(0, 48, 0), "Wednesday"=>array_fill(0, 48, 0), "Thursday"=>array_fill(0, 48, 0), "Friday"=>array_fill(0, 48, 0), "Saturday"=>array_fill(0, 48, 0), "Sunday"=>array_fill(0, 48, 0) );
            while ($row = $result->fetch_assoc()) {
                for ($x = $row["start_time"]; $x < $row["end_time"]; $x+=50) {
                    if ($x%100 == 30) {
                        $x += 20;
                    }
                    $index = (int)($x/50);
                    $times[$row["day"]][$index-1]++;
                }
            }
            
            $time_one = getTopTime($times);
            $time_two =  getTopTime($times);
            $time_three = getTopTime($times);

            $topTime = array($time_one, $time_two, $time_three);
            return $topTime;
        }
    } else {
        echo "Unable to get top times";
    }
}

function getTopLocations() {
    $conn = Database::getConnection();
    $sql = "SELECT location_prefs.loc, location_prefs.rank
                FROM location_prefs
                JOIN group_members
                    ON group_members.user_id=location_prefs.user_id
                WHERE group_members.group_id ='f9cf65d737dc382b18f96ac9';";
    if ($result = mysqli_query($conn, $sql)) {
        if ($result->num_rows > 0) {
            $locations = array();
            while ($row = $result->fetch_assoc()) {
                if (isset($locations[$row["loc"]])) {
                    $locations[$row["loc"]] += (10-$row["rank"]);
                } else {
                    $locations[$row["loc"]] = (10-$row["rank"]);
                }
            }
            arsort($locations);
            return $locations;
        }
    } else {
        echo "Unable to get top locations";
    }
}
?>


<!DOCTYPE html>

<head>
    <Title>Test page</Title>
</head>
<body>
    <form method="POST" action="meetingForm.php">
        <select name="meeting_time">
            <?php
                $topLocations = getTopLocations();
                foreach($topLocations as $locations=>$ranks) {
                    echo "<option value = '" . $locations . "'>" . $locations . "</option>";
                }
            ?>
        </select>
        <select name="meeting_location">
            <?php
                $topTimes = getTopTimes();
                foreach($topTimes as $times) {
                    echo "<option value = '" . $times["day"] . " " . $times["time"] . "'>" . $times["day"] . " " . $times["time"] . "</option>";
                }
            ?>
        </select>
        <br><br>
        
        <input type="submit" name="request_meeting" value="Submit">
    </form>
</body>

</html>