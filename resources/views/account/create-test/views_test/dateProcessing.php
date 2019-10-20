<?php
session_start();
if (isset($_GET['out'])){
    header('Location: /');
    session_destroy();
}
if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}
require "../../../../../autoload.php";
require '../../../../../vendor/autoload.php';


use app\User;
use app\Admin;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$user = new User();
$admin = new Admin();
echo $admin->editTests(15);
$title = $_POST['title_test'];
if (isset($_GET['del_user'])) {
    $id_user = $_GET['del_user'];
    $admin->deleteUser($id_user);
}
$id = $_SESSION['user'][0];
$arr = str_replace("<", "&lt;", $_POST);

$array_answer = [];
$sql = $admin->query("SELECT * FROM `ans_question` WHERE name_test='$title'");
while ($test = $sql->fetch_assoc()){
    $test_rep = str_replace("<", "&lt;", $test['ans']);
    array_push($array_answer, $test_rep);
}
$arr_post = [];
for ($i = 0; $i < 12; $i++){
    array_push($arr_post, $arr['group' . $i]);
}
$true_ans = 0;
$false_ans = 0;
for ($i = 0; $i < 12; $i++){
    if (substr($arr_post[$i], 0) != substr($array_answer[$i], 0)) {
        $false_ans++;
    } else {   // иначе
        $true_ans++;
    }
}
$email = $_GET['email'];

$name = $admin->getEmailUser('name', $email);
$surname = $admin->getEmailUser('surname', $email);
if ($true_ans > 1){
    $test_true = $true_ans;
}elseif ($true_ans == 0){
    $true_ans = 1;
    $test_true = $true_ans;
}
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../../../../../public/css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" href="../../../../../public/css/style.css">
        <title>Kit Test</title>
    </head>
    <body>
    <div class="container">
        <div class="row background-user z-depth-2" style="padding: 40px">
            <h4>Тестирование KIT-TEST</h4>
            <div class="row">
                <div class="input-field col s12">
                    Ваши результаты были отправлены к вам на почту. <br><br>
                    <a href="/" class="waves-effect waves-light btn-large blue-grey darken-4 white-text">на главную</a>
                </div>
            </div>

        </div>
    </div>
    </body>
<?php

$subject = 'Результаты тестрирования на сайте KIT-TEST';
$body    = "<p>Здравствуйте: <strong> $name $surname </strong>, результаты теста: <p>Название теста: <strong>$title</strong></p><p>Ваш балл: <strong>$test_true</strong></p><p>";
if (!empty($email)){
    $admin->sendEmail($subject,$body,$email);
}
