<?php
require "../../../../autoload.php";
use app\User;
use app\Admin;
use app\Connection;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../../vendor/autoload.php';

$connetion = new User();
$admin = new Admin();
session_start();

$code = $_POST['code'];
$code_password = $_POST['code_password'];
$email = $_GET['email'];


if (isset($_POST['action_code'])){
    if ($code_password != $code){
        header("Location: confirmation_password?email=$email");
    }else {
        $new_password_comf = $_POST['new_password_comf'];

        $id = $admin->getEmailUser('id', $email);
        $login = $admin->getEmailUser('login', $email);
        $pass_hash = password_hash($new_password_comf, PASSWORD_DEFAULT);
        $name = $admin->getEmailUser('name', $email);
        $surname = $admin->getEmailUser('surname', $email);
        $date = $admin->getEmailUser('birth_date', $email);
        $email_row = $admin->getEmailUser('email', $email);
        $token = $admin->getEmailUser('token', $email);
        $verefy = $admin->getEmailUser('verefy', $email);
        $phone = $admin->getEmailUser('tel', $email);
        $date_registartion = $admin->getEmailUser('registration_date', $email);
        $group = $admin->getEmailUser('group_id', $email);
        $role = $admin->getEmailUser('role_id', $email);

        if($admin->updateUser($id,$login,$pass_hash,$name,$surname,$date,$email_row,$token,$verefy,$phone,$date_registartion,$group,$role)){
            $code = uniqid();
            $admin->sendEmail('Новые данные для входа в аккаунт на сайте KIT-TEST',"<p><strong>Данные для входа в акканут</strong></p><p><strong>Логин: $login </strong></p><p><strong>Новый пароль: $new_password_comf </strong></p>",$email);
            header("Location: /");
        }

    }
}