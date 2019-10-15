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

$email = $_GET['email'];

$new_password = $_POST['new_password'];
$rep_new_password = $_POST['rep_new_password'];

$id = $admin->getEmailUser('id', $email);

$db_pass = $admin->getEmailUser('password', $email);
if (isset($email)){
    if (strlen($new_password) < 6){
        header("Location: password?email=$email");
    }else{
        if ($new_password != $rep_new_password){
            header("Location: password?email=$email");
        }else{
            $code = uniqid();
            $admin->sendEmail('Смена пароля на сайте KIT-TEST',"<p><strong>Смена пароля</strong>, ваши код для смены пароля</p><p><strong>Код: $code </strong></p>",$email);
        }
    }

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
    <link type="text/css" rel="stylesheet" href="/public/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="/public/css/style.css">
    <title>Kit Test</title>
</head>
<body>
<nav>
    <div class="container">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center"><img src="http://kitit.com.ua/wp-content/uploads/2018/12/cropped-logo_kit_w-1.png" width="65" height="65" alt=""></a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/resources/views/account/hub-test">На главную</a></li>
                <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo $_SESSION['user'][1] ?><i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="/resources/views/account/profile">Профиль</a></li>
                <li><a href="?out">Выход</a></li>
            </ul>
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="/resources/views/account/profile">Профиль</a></li>
                <li><a href="?out">Выход</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row background-user z-depth-2" style="padding: 40px">
        <h4>Создание нового пароля</h4>
        <blockquote>
            Код для потверждения личности пришёл вам на почту.
        </blockquote>
        <form action="verefy_new_password?email=<?php echo $email ?>" method="post" class="col s12">
            <input type="hidden" name="code" value="<?php echo $code?>" >
            <input type="hidden" name="new_password_comf" value="<?php echo $new_password?>" >
            <input type="hidden" name="rep_new_password_comf" value="<?php echo $rep_new_password?>" >

            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="code_password" name="code_password" type="text" class="validate" required>
                    <label for="code_password">Введите код</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="action_code">Проверить код
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
require "../../layouts/footer.php";
?>
