<?php

class TimePreference {
    public $day;
    public $start_time;
    public $end_time;

    function __construct($day, $start, $end) {
        $this->day = $day;
        $this->start_time = $start;
        $this->end_time = $end;
    }
}

function addSingleDayPrefs($day, $times) {
    if (!checkSession()) {
        return array("success" => false,
                    "message" => "Session not created");
    }
    if(!validateInput($day)) {
        logSecurityMessage($_SESSION["user_id"] . "'s day pref did not validate");
        return array("success" => false,
                    "message" => "Day specified did not pass input validation");
    }
    $conn = Database::getConnection();
    $u_id = $_SESSION["user_id"];
    $sql = "DELETE FROM datetime_prefs
        WHERE user_id='" . $u_id
        . "' AND day='" . $day . "';";
    if(!mysqli_query($conn, $sql)) {
        return array("success" => false,
                    "message" => "Could not remove previous time preferences");
    }
    $ret = array();
    foreach($times as $t) {
        array_push($ret, new TimePreference($day, $t, $t + 100));
    }
    return addTimePreferences($ret);
}

function addTimePreferences($time_list) {
    $conn = Database::getConnection();
    if (checkSession()) {
        $failed = array();
        foreach($time_list as $value) {
            $day = $value->day;
            $start_time = $value->start_time;
            $end_time = $value->end_time;
            if(!validateInput($day)
                || !validateInput($start_time . "")
                || !validateInput($end_time . "")) {
                    logSecurityMessage("One of " . $_SESSION["user_id"] . "'s time prefs did not validate");
                    continue;
                }
            $sql = "INSERT INTO datetime_prefs (user_id, day, start_time, end_time)";
            $sql.= " VALUES ('" . $_SESSION["user_id"] . "', '"
            . $day . "', '"
            . $start_time . "', '"
            . $end_time . "');";
            if ($result = mysqli_query($conn, $sql)) {
                // echo "Time preference added <br>";
            } else {
                array_push($failed, $day . " : " . $start_time . " - " . $end_time);
            }
        }
        if(sizeof($failed) != 0) {
            return array("success" => false,
                        "message" => "One or more of the time preferences failed to update",
                        "details" => $failed);
        }
        return array("success" => true,
                    "message" => "Successfully added time preferences");
    } else {
        return array("success" => false,
                    "message" => "Session not created");
    }
}

?>