<?php
namespace app;
use mysqli;

class Connection {
    private $connection;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db = 'test_kit';
    //Подключение базы данных
    public function __construct() {
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);
    }
    //Обработка sql запроса
    public function query($sql) {
        return $this->connection->query($sql);
    }
}

//include "AbstractModel.php";
//include "User.php";
//include "UserObject.php";

