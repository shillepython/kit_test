<?php
session_start();
require "../app/Connection.php";
use app\User;

$connection = new User();
$login = trim($_POST['login']);
$password = trim($_POST['password']);
$result_pass_login = $connection->sign_in($login,$password);
$num = $connection->select_num_rows($login,$password);
if($num == 1) {
    $_SESSION['user'] = array($result_pass_login['id'], $result_pass_login['login'], $result_pass_login['password'], $result_pass_login['name'], $result_pass_login['surname'], $result_pass_login['birth_date'], $result_pass_login['email'], $result_pass_login['tel'], $result_pass_login['registration_date'], $result_pass_login['group_id'], $result_pass_login['role_id']);
    header('Location: ../resources/views/account/hub-test.php');
} else{
    header('Location: ../resources/views/signin/signin.php');
}