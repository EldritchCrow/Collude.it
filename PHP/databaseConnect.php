<?php

if(!defined(MAIN_APP_RUN)) {
    http_response_code(404);
    die();
}

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

?>