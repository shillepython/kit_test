<?php
namespace app;
use mysql;
class Admin extends UserObject {
    private $table = '`users`';

    //Получить всю таблицу
    public function AllTable(){
        return parent::query("SELECT * FROM " . $this->table);
    }

    //Получить таблицу роль
    public function roleTable(){
        return parent::query("SELECT * FROM `roles`");
    }

    //Получить айди пользователя
    public function getId($id) {
        return parent::query("SELECT * FROM `users` WHERE id='$id'");
    }

    //Удаление пользователя
    public function deleteUser($id)
    {
        return parent::query("DELETE FROM " . $this->table . " WHERE id = '$id'");
    }

    //Обновление данных пользователя
    public function updateUser($id,$login,$password,$name,$surname,$birth_date,$email,$phone,$today,$group_id,$role_id)
    {
        return parent::query("UPDATE `users` SET login='$login', password='$password', name='$name', surname='$surname', birth_date='$birth_date', email='$email', tel='$phone', registration_date='$today', group_id='$group_id', role_id='$role_id' WHERE id=$id");
    }


    public function editTests ($id){

    }
    public function deleteTests ($id){
        //
    }
}
