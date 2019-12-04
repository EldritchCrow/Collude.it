<?php

// if(!defined("MAIN_APP_RUN")) {
//     http_response_code(404);
//     die();
// }

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



function getTopTimes() {
    $conn = Database::getConnection();
    $sql = "SELECT datetime_prefs.start_time, datetime_prefs.end_time, datetime_prefs.day
                FROM datetime_prefs
                JOIN group_members
                    ON group_members.user_id=datetime_prefs.user_id
                WHERE group_members.group_id ='50573eb468d497764df6e4b6';";
    if ($result = mysqli_query($conn, $sql)) {
        if ($result->num_rows > 0) {
            $times = array( "Monday"=>array_fill(0, 48, 0), "Tuesday"=>array_fill(0, 48, 0), "Wednesday"=>array_fill(0, 48, 0), "Thursday"=>array_fill(0, 48, 0), "Friday"=>array_fill(0, 48, 0), "Saturday"=>array_fill(0, 48, 0), "Sunday"=>array_fill(0, 48, 0) );
            $max = 0;
            while ($row = $result->fetch_assoc()) {
                for ($x = $row["start_time"]; $x < $row["end_time"]; $x+=50) {
                    if ($x%100 == 30) {
                        $x += 20;
                    }
                    $index = (int)($x/50);
                    $times[$row["day"]][$index-1]++;
                    if ($max < $times[$row["day"]][$index-1]) {
                        $max = $times[$row["day"]][$index-1];
                    }
                }
                echo $row["start_time"] . " " . $row["end_time"] . " " . $row["day"] . "<br>";
            }
            echo $max . "<br>";
            foreach($times as $x=>$value) {
                foreach($value as $info) {
                    echo "$info ";
                }
                echo "<br>";
            }
        }
    } else {
        echo "sad";
    }
}

getTopTimes();


?>