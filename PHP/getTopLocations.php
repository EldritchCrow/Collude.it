<?php

function getTopLocations() {
    $conn = Database::getConnection();
    $sql = "SELECT location_prefs.loc, location_prefs.rank
                FROM location_prefs
                JOIN group_members
                    ON group_members.user_id=location_prefs.user_id
                WHERE group_members.group_id ='" . $_SESSION["group_id"] . "';";
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