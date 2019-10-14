<?php
require "../autoload.php";
use app\User;
use app\Admin;
use app\Connection;

$connetion = new User();
$admin = new Admin();
session_start();

$login = trim($_POST['login']);
$password = trim($_POST['password']);

$bd_pass = $admin->getPasswordUser('password', $login);
$result_pass_login = $connetion->verefy_password($login,$password,$bd_pass);
$num = $connetion->select_num_rows($login,$password,$bd_pass);
if($num == 1) {
    $_SESSION['user'] = array($result_pass_login['id'], $result_pass_login['login'], $password, $result_pass_login['name'], $result_pass_login['surname'], $result_pass_login['birth_date'], $result_pass_login['email'], $result_pass_login['tel'], $result_pass_login['registration_date'], $result_pass_login['group_id'], $result_pass_login['role_id']);
    header('Location: ../resources/views/account/hub-test');
} else{
    header('Location: ../resources/views/signin/signin');
}