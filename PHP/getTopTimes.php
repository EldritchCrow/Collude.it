<?php

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
                WHERE group_members.group_id ='" . $_SESSION["group_id"] . "';";
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

?>