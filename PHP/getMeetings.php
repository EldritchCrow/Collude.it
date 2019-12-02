<?php
    function getMeetings() {
        if (checkSession()) {
            $conn = Database::getConnection();
            $sql = "SELECT m_time, m_location FROM meetings WHERE confirmed = 1 AND group_id = '"
            . $_SESSION["group_id"] . "';";
            if ($result = mysqli_query($conn, $sql)) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "Meeting Time: " 
                        . $row["m_time"] 
                        . " Location: "
                        . $row["m_location"]
                        . "<br>";
                    }
                } else {
                    echo "0 results <br>";
                }    
                return true;
            } else {
                echo "Something fucked up:<br>" . mysqli_error($conn) . "<br>";
                return false;
            }  
        } else {
            echo "Session is not created";
            return false;
        }
    }
?>