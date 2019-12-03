<?php

function logSecurityMessage($message) {
    $fp = fopen("security_log.txt", "a");
    fwrite($fp, $message . "\n");
    fclose($fp);
}

?>