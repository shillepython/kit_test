<?php
namespace app;
use mysqli;

trait Connection {
    private static $connection;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db = 'test_kit';
    //Подключение базы данных
    public function __construct() {
        self::$connection = new mysqli($this->host, $this->user, $this->pass, $this->db);
    }
    public static function query($sql) {
        return self::$connection->query($sql);
    }
}

