<?php
namespace app;
use mysql;

class User extends UserObject{
    private $table = '`users`';

    public function query_login_password($login,$password)
    {
        return $conn = $this->query("SELECT * FROM " . $this->table . " WHERE login = '$login' AND password = '$password'");
    }

    // СОВПАДЕНИЕ ЛОГИНА И ПАРОЛЯ С ВЕДЕННЫМИ ДАННЫМИ ПОЛЬЗОВАТЕЛЕМ num_rows Регистрация
    public function query_log($login,$password)
    {
        $result_pass_login = $this->query_login_password($login,$password);
        $row = $result_pass_login->num_rows;
        return $row;
    }

    // СОВПАДЕНИЕ ЛОГИНА И ПАРОЛЯ С ВЕДЕННЫМИ ДАННЫМИ ПОЛЬЗОВАТЕЛЕМ fetch_assoc Авторизация
    public function query_log_pass($login,$password) {
        $result_pass_login = $this->query_login_password($login,$password);
        $row = $result_pass_login->fetch_assoc();
        return $row;
    }
    public function select_num_rows($login,$password) {
        $result_row = $this->query("SELECT * FROM " . $this->table . " WHERE login = '$login' AND password = '$password'");
        $num = $result_row->num_rows;
        return $num;
    }
    //Добавление ногово пользователя
    public function add_user_sql($login,$password,$name,$surname,$birth_date,$email,$phone,$today,$role_id)
    {
        $add = "INSERT INTO $this->table (login,password,name,surname,birth_date,email,tel,registration_date,role_id) VALUES ('$login','$password','$name','$surname','$birth_date','$email','$phone','$today','$role_id')";
        $this->query($add);
        return $add;
    }
    public function phpmailler() {
        return $this->query("SELECT * FROM " . $this->table . " ORDER BY user_id DESC LIMIT 1");
    }

}