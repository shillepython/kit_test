<?php
namespace app;
use mysql;

class UserObject extends User{
    private $table = '`users`';
    //Получение данных пользователя по ключу из масива $_SESSION
    public function sessionUser($id) {
        return $_SESSION['user'][$id];
    }
    //Получение данных пользователя по ключу
    public function dateUser($id,$user_row) {
        $selectDateUSer = parent::query("SELECT * FROM " . $this->table . " WHERE id = '$id'");
        while ($row = $selectDateUSer->fetch_row()) {
            return $row[$user_row];
        }
    }
}