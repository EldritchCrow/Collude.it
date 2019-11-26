<?php
    function checkLastUpdate($last_update) {
        $current_time = time();
        if ($current_time - $last_update > 360) {
            return false;
        }
        else (
            return true;
        )
    }
?>