<?php
namespace app;
use mysql;

class UserObject extends AbstractModel{
    private $table = '`users`';
    //Обновление данных пользователя
    //Пример использования - $user->updateUser(105,'shille','cthfabv123', 'Серафим', 'Семихат','06.07.2004', 'shillenetwork@gmail.com','0980193160','2019-03-10','Отсутствует','1');

    public function whileSearch($name) {
        while ($row = $name->fetch_row()){
            echo "<tr>";
            echo "<td>" . $row[1] . " </td>";
            echo "<td>" . $row[2] . " </td>";
            echo "<td>" . $row[3] . " </td>";
            echo "<td>" . $row[4] . " </td>";
            echo "<td>" . $row[5] . " </td>";
            echo "<td>" . $row[6] . " </td>";
            echo "<td>" . $row[7] . " </td>";
            echo "<td>" . $row[8] . " </td>";
            echo "<td>" . $row[9] . " </td>";
            if($row[10] == '3') {echo "<td>" . 'админ' . "</td>";}if ($row[10] == '2'){echo "<td>" . 'автор' . "</td>";}if ($row[10] == '1'){echo "<td>" . 'пользователь' . "</td>";};
            echo "</tr>";
        }
    }
    //Поиск пользователя
    public function searchUser($name)
    {
        $searhuser = parent::query("SELECT * FROM " . $this->table . " WHERE `login` LIKE '%$name%'");
        $this->whileSearch($searhuser);

    }
    public function searchUserGroup($group) {
        $searhGroup = parent::query("SELECT * FROM " . $this->table . " WHERE `group_id` LIKE '%$group%'");
        $this->whileSearch($searhGroup);
    }

    //ЗАГРУЗКА ФАЙЛОВ ПРИ СОЗДАНИИ ТЕСТОВ \НАЧАЛО\

//ЗАГРУЗКА ФАЙЛОВ ПРИ СОЗДАНИИ ТЕСТОВ \КОНЕЦ\
    public function getElementsTable($row_table,$id)
    {
        $getGroup =  parent::query("SELECT `$row_table` FROM `users` WHERE id='$id'");
        $row_ass = $getGroup->fetch_assoc();
        return $row_ass[$row_table];
    }

}

