<?php
namespace app;
use mysql;
class UserObject extends AbstractModel{
    private $table = '`users`';
    //Обновление данных пользователя
    //Пример использования - $user->updateUser(105,'shille','cthfabv123', 'Серафим', 'Семихат','06.07.2004', 'shillenetwork@gmail.com','0980193160','2019-03-10','Отсутствует','1');
    function query($sql)
    {
        return Connection::getInstance()->query($sql);
    }


    public function getElementsTable($row_table,$id)
    {
        $getGroup =  $this->query("SELECT `$row_table` FROM `users` WHERE id='$id'");
        $row_ass = $getGroup->fetch_assoc();
        return $row_ass[$row_table];
    }
}

