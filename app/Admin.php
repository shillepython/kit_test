<?php
namespace app;
use mysql;
class Admin extends UserObject {
    private $table = '`users`';

    //Получить всю таблиц
    public function AllTable(){
        return $this->query("SELECT * FROM " . $this->table);
    }

    //Получить таблицу роль
    public function roleTable(){
        return $this->query("SELECT * FROM `roles`");
    }

    //Получить айди пользователя из бл по id
    public function getId($id) {
        return $this->query("SELECT * FROM `users` WHERE id='$id'");
    }

    //Удаление пользователя
    public function deleteUser($id)
    {
        return $this->query("DELETE FROM " . $this->table . " WHERE id = '$id'");
    }

    //Обновление данных пользователя
    public function updateUser($id,$login,$password,$name,$surname,$birth_date,$email,$phone,$today,$group_id,$role_id)
    {
        return $this->query("UPDATE `users` SET login='$login', password='$password', name='$name', surname='$surname', birth_date='$birth_date', email='$email', tel='$phone', registration_date='$today', group_id='$group_id', role_id='$role_id' WHERE id=$id");
    }


    public function out_test() {
        return $this->query("SELECT * FROM `out_test`");
    }






    public function return_row($row_table,$getTest) {
        $row_ass = $getTest->fetch_assoc();
        return $row_ass[$row_table];
    }

    public function getTestTable($row_table,$id) {
        $get_select = $this->query("SELECT `$row_table` FROM `out_test` WHERE id='$id'");
        return $this->return_row($row_table,$get_select);
    }

    public function getPasswordUser($row_table,$login) {
        $get_select = $this->query("SELECT `$row_table` FROM `users` WHERE login='$login'");
        return $this->return_row($row_table,$get_select);
    }

    public function getEmailUser($row_table,$email) {
        $get_select = $this->query("SELECT `$row_table` FROM `users` WHERE email='$email'");
        return $this->return_row($row_table,$get_select);
    }





    public function editTests ($id){
        //
    }
}
