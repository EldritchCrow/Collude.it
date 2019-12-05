<?php

function logSecurityMessage($message) {
    $fp = fopen("security_log.txt", "a");
    fwrite($fp, $message . "\n");
    fclose($fp);
}

function validateInput($input) {
    // There is no need for anything other than alphanumeric characters probably
    // So this is guarenteed not to be a CLI (I hope)
    // We don't log a security error since this can be a common mistake
    return ctype_alnum(str_replace(" ", "", $input)) && str_replace(" ", "", $input) != "";
}

?>