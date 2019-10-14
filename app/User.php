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
    public function query_log($login,$password,$email)
    {
        if($result_pass_login = $this->query("SELECT * FROM " . $this->table . " WHERE login = '$login' AND password = '$password' AND email = '$email'")){
            $row = $result_pass_login->num_rows;
            return $row;
        }else{
            return false;
        }
    }
    function select_login($login) {
        return $this->query("SELECT * FROM " . $this->table . " WHERE login = '$login'");
    }

    public function verefy_password($login,$password,$bd_pass) {
        if(password_verify($password, $bd_pass)){
            $result_pass_login = $this->select_login($login);
            $row = $result_pass_login->fetch_assoc();
            return $row;
        }else{
            return false;
        }
    }

    public function select_num_rows($login,$password,$bd_pass) {
        if(password_verify($password, $bd_pass)){
            $result_row = $this->select_login($login);
            $num = $result_row->num_rows;
            return $num;
        }else{
            return false;
        }
    }

    // СОВПАДЕНИЕ ЛОГИНА И ПАРОЛЯ С ВЕДЕННЫМИ ДАННЫМИ ПОЛЬЗОВАТЕЛЕМ fetch_assoc Регистрация
    public function query_log_pass($login,$password,$email) {
        $result_pass_login = $this->query("SELECT * FROM " . $this->table . " WHERE login = '$login' AND password = '$password' AND email = '$email'");
        $row = $result_pass_login->fetch_assoc();
        return $row;
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