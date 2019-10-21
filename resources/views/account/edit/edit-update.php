<?php
session_start();
if (isset($_GET['out'])){
    header('Location: hub-test');
    session_destroy();
    exit();
}
if (!isset($_SESSION['user'])) {
    header('Location: hub-test');
    exit();
}
include "../../../../autoload.php";

use app\User;
use app\UserObject;
use app\Admin;

$connection = new User();
$user = new UserObject();
$admin = new Admin();

$id = $_SESSION['user'][0];

if ($admin->getElementsTable('verefy',$id) != 1){
    header("Location: /");
}


if ($admin->getElementsTable('login',$id) == ''){
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
$token = $admin->getElementsTable('token',$id);
$verefy = $admin->getElementsTable('verefy',$id);
$phone = $_POST['phone'];
$group = $_POST['group'];
$date_registartion = $_POST['date_registartion'];
$role = $_POST['role_select'];

if ($update = $admin->updateUser($id,$login,$password,$name,$surname,$date,$email,$token,$verefy,$phone,$date_registartion,$group,$role)){
    header('Location: ../admin-user');
}
