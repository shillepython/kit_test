<?php
session_start();
if (isset($_GET['out'])){
    header('Location: /');
    session_destroy();
    exit();
}
if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}
require "../../../../app/Connection.php";
use app\User;
use app\UserObject;

$connection = new User();
$user = new UserObject();

$id = $_SESSION['user'][0];

if ($user->dateUser($id,1) == ''){
    session_destroy();
    if (!isset($_SESSION['user'])){
        header('Location: /');
        exit();
    }
}

$id = $_POST['id'];
$login = $_POST['login'];
$password = $_POST['password'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$date = $_POST['date'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$group = $_POST['group'];
$date_registartion = $_POST['date_registartion'];
$role = $_POST['role_select'];

if ($update = $user->updateUser($id,$login,$password,$name,$surname,$date,$email,$phone,$date_registartion,$group,$role)){
    header('Location: ../admin-user.php');
}
