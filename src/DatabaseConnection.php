<?php

namespace src;

final class DatabaseConnection
{
    private static $instance = null;
    private static $connection;

    // Singleton connection to the Db
    public static function getInstance()
    {
        if (is_null(self::$instance)){
            self::$instance = new DatabaseConnection();
        }

        return self::$instance;
    }

    private function __construct() {}

    private function __clone() {}

    public function __wakeup() {}

    public static function connect($host, $dbName, $user, $password)
    {
        self::$connection = new \PDO("mysql:host=$host;port=3306;dbname=$dbName", $user,$password);
    }

    public static function getConnection()
    {
        return self::$connection;
    }
}
