<?php
require "../../../autoload.php";
use app\User;
use app\Admin;
use app\Connection;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../vendor/autoload.php';

$connetion = new User();
$admin = new Admin();
session_start();

$email = $_GET['email'];
$password = $_GET['password'];

$id = $admin->getEmailUser('id', $email);
$login = $admin->getEmailUser('login', $email);
$pass_hash = password_hash($password, PASSWORD_DEFAULT);
$name = $admin->getEmailUser('name', $email);
$surname = $admin->getEmailUser('surname', $email);
$date = $admin->getEmailUser('birth_date', $email);
$email_row = $admin->getEmailUser('email', $email);
$phone = $admin->getEmailUser('tel', $email);
$date_registartion = $admin->getEmailUser('registration_date', $email);
$group = $admin->getEmailUser('group_id', $email);
$role = $admin->getEmailUser('role_id', $email);

if (isset($_GET['email'])){

    if ($admin->updateUser($id,$login,$pass_hash,$name,$surname,$date,$email_row,$phone,$date_registartion,$group,$role)) {

        if($admin->getEmailUser('email', $email)){
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
                $mail->Body    = "<p><strong>Востановление пароля</strong>, ваши контактные данные для входа в аккаунт</p><p><strong>Логин: $login </strong></p><p><strong>Новый пароль: $password </strong><p>";

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            header("Location: /");
        }else{

            echo 'Почта не существует!';

        }
    }
}
?>