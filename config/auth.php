<?php
session_start();
require "../autoload.php";
use app\User;

$connection = new User();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$login = trim($_POST['login']);
$today = date("y.m.d");
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$birth_date = trim($_POST['date']);
$role_id = 1;

$result_row_login = $connection->query_log($login,$password);
if($result_row_login == 0) {
    if ($connection->add_user_sql($login, $password, $name, $surname, $birth_date, $email, $phone, $today, $role_id)) {
        $result_pass_login = $connection->query_log_pass($login,$password);
        $_SESSION['user'] = array($result_pass_login['id'], $result_pass_login['login'], $result_pass_login['password'], $result_pass_login['name'], $result_pass_login['surname'], $result_pass_login['birth_date'], $result_pass_login['email'], $row_auth['tel'], $result_pass_login['registration_date'], $result_pass_login['group_id'], $result_pass_login['role_id']);
        header('Location: ../resources/views/account/hub-test');
    }
}else {
    header('Location: /');
    exit();
}


$id = $_SESSION['user'][0];


$result = $connection->phpmailler(); if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $email = $row["email"];
        $login = $row['login'];
        $name = $row['name'];
        $surname = $row['surname'];
        $password = $row['password'];
        echo "<br>";
    }
}

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'shillenetwork@gmail.com';                     // SMTP username
    $mail->Password   = 'Cthfabv123';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;
    $mail->CharSet = 'UTF-8';
    // TCP port to connect to

    //Recipients
    $mail->setFrom('shillenetwork@gmail.com', 'Kit-Test');
    $mail->addAddress($email, 'Kit-Test.ua');     // Add a recipient


    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Регистрация на сайте KIT-TEST';
    $mail->Body    = '<p>Добрый день: <strong>' . $name .' ' . $surname .'</strong>, ваши контактные данные для входа в аккаунт</p><p><strong>Логин: '. $login . '</strong></p><p><strong>Пароль: '. $password .'</strong><p>';

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
