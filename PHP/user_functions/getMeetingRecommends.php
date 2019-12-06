<?php

include_once("../library.php");
if($_SERVER["REQUEST_METHOD"] != "GET") {
    http_response_code(400);
    die();
}

if(!checkSession()) {
    return json_encode(
        array("success" => false,
                "message" => "Session not created"));
}

$topLocations = getTopLocations();
$topLocs = array();
foreach($topLocations as $location=>$rank) {
    array_push($topLocs, array("loc" => $location));
}
$topTimes = getTopTimes();
echo json_encode(
        array("success" => true,
                "message" => "Successfully retrieved top times",
                "times" => $topTimes,
                "locs" => $topLocs));
?>