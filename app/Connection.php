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
abstract class Database extends Connection {
    abstract public function AllTable();
    abstract public function roleTable();
    abstract public function getId($id);
    abstract public function add_user_sql($login,$password,$name,$surname,$birth_date,$email,$phone,$today,$role_id);
    abstract public function query_log_pass($login,$password);
    abstract public function query_log($login);
    abstract public function sign_in($login,$password);
    abstract public function select_num_rows($login,$password);
    abstract public function deleteUser($id);
    abstract public function getGroupUser($id);
    abstract public function searchUser($name);
    abstract public function searchUserGroup($group);
    abstract public function uploadFile($name_tets,$file_json);
}
class User extends Database{
    private $table = '`users`';
    public function AllTable(){
        return parent::query("SELECT * FROM " . $this->table);
    }
    public function roleTable(){
        return parent::query("SELECT * FROM `roles`");
    }
    public function getId($id) {
        return parent::query("SELECT * FROM `users` WHERE id='$id'");
    }

    // СОВПОДЕНИЕ ЛОГИНА С ВЕДЕННЫМ ДАННЫМИ ПОЛЬЗОВАТЕЛЕМ
    public function query_log($login)
    {
        $result_log = parent::query("SELECT * FROM " . $this->table . " WHERE login = '$login'");
        $row = $result_log->num_rows;
        return $row;
    }

    // СОВПОДЕНИЕ ЛОГИНА И ПАРОЛЯ С ВЕДЕННЫМИ ДАННЫМИ ПОЛЬЗОВАТЕЛЕМ
    public function query_log_pass($login,$password) {
        $result_pass_login = parent::query("SELECT * FROM " . $this->table . " WHERE login = '$login' AND password = '$password'");
        $row_auth = $result_pass_login->fetch_assoc();
        return $row_auth;
    }

    //Добавление ногово пользователя
    public function add_user_sql($login,$password,$name,$surname,$birth_date,$email,$phone,$today,$role_id)
    {
        $add = "INSERT INTO $this->table (login,password,name,surname,birth_date,email,tel,registration_date,role_id) VALUES ('$login','$password','$name','$surname','$birth_date','$email','$phone','$today','$role_id')";
        parent::query($add);
        return $add;
    }

    //Удаление пользователя
    public function deleteUser($id)
    {
        return parent::query("DELETE FROM " . $this->table . " WHERE id = '$id'");
    }

    //Обновление данных пользователя
    //Пример использования - $user->updateUser(105,'shille','cthfabv123', 'Серафим', 'Семихат','06.07.2004', 'shillenetwork@gmail.com','0980193160','2019-03-10','Отсутствует','1');
    public function updateUser($id,$login,$password,$name,$surname,$birth_date,$email,$phone,$today,$group_id,$role_id)
    {
        return parent::query("UPDATE `users` SET login='$login', password='$password', name='$name', surname='$surname', birth_date='$birth_date', email='$email', tel='$phone', registration_date='$today', group_id='$group_id', role_id='$role_id' WHERE id=$id");
    }

    public function getGroupUser($id)
    {
        $getGroup =  parent::query("SELECT `group_id` FROM " . $this->table . " WHERE id='$id'");
        $row = $getGroup->fetch_assoc();
        return $row['group_id'];
    }

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

//select * from `news` where `text` like '%"'.$_POST['search'].'"%' ;
    //Вход пользователя
    public function sign_in($login,$password) {
        $result_pass_login = parent::query("SELECT * FROM " . $this->table . " WHERE login = '$login' AND password = '$password'");
        $row = $result_pass_login->fetch_assoc();
        return $row;
    }
    //Полечение строк определённого пользователя
    public function select_num_rows($login,$password) {
        $result_row = parent::query("SELECT * FROM " . $this->table . " WHERE login = '$login' AND password = '$password'");
        $num = $result_row->num_rows;
        return $num;
    }


    //ЗАГРУЗКА ФАЙЛОВ ПРИ СОЗДАНИИ ТЕСТОВ \НАЧАЛО\
    public function create_json($file_txt_upload,$name_tets) {
        $file_read_txt = file($file_txt_upload);
        $file_json_encode = json_encode($file_read_txt);
        $file = 'json-file/'.uniqid() . '_' . date("m.d.y"). "_" . $name_tets .".json";
        if (!file_exists($file)) {
            $fcreate = fopen($file, "w");
            fwrite($fcreate, $file_json_encode);
            fclose($fcreate);
        }
    }

    public function uploadFile($name_tets,$file_json) {
        $extension = pathinfo($file_json['name'], PATHINFO_EXTENSION);
        $file_txt_upload = 'txt-file/'.uniqid()  . '_' . date("m.d.y") . "_" . $name_tets . "." . $extension;
        move_uploaded_file($file_json['tmp_name'], $file_txt_upload);

        $this->create_json($file_txt_upload,$name_tets);

        header('Location: /');
        return $file_txt_upload;
    }
//ЗАГРУЗКА ФАЙЛОВ ПРИ СОЗДАНИИ ТЕСТОВ \КОНЕЦ\
}

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
