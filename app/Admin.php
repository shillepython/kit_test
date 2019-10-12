<?php
namespace app;
use mysql;
class Admin extends UserObject {
    private $table = '`users`';

    //Получить всю таблицу
    public function AllTable(){
        return Admin::query("SELECT * FROM " . $this->table);
    }

    //Получить таблицу роль
    public function roleTable(){
        return Admin::query("SELECT * FROM `roles`");
    }

    //Получить айди пользователя из бл по id
    public function getId($id) {
        return Admin::query("SELECT * FROM `users` WHERE id='$id'");
    }

    //Удаление пользователя
    public function deleteUser($id)
    {
        return Admin::query("DELETE FROM " . $this->table . " WHERE id = '$id'");
    }

    //Обновление данных пользователя
    public function updateUser($id,$login,$password,$name,$surname,$birth_date,$email,$phone,$today,$group_id,$role_id)
    {
        return Admin::query("UPDATE `users` SET login='$login', password='$password', name='$name', surname='$surname', birth_date='$birth_date', email='$email', tel='$phone', registration_date='$today', group_id='$group_id', role_id='$role_id' WHERE id=$id");
    }


    public function out_test() {
        return Admin::query("SELECT * FROM `out_test`");
    }
    public function getTestTable($row_table,$id) {
        $getTest =  Admin::query("SELECT `$row_table` FROM `out_test` WHERE id='$id'");
        $row_ass = $getTest->fetch_assoc();
        return $row_ass[$row_table];
    }

    public function editTests ($id){
        //
    }
}
