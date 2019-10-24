<?php
session_start();
if (isset($_GET['out'])){
    session_destroy();
    header('Location: /');
}
if (!isset($_SESSION['user'])){
    header('Location: /');
    exit();
}
require "../../../../autoload.php";
use app\User;
use app\Admin;
use app\Connection;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../../vendor/autoload.php';

$connetion = new User();
$admin = new Admin();

$email_get = $_GET['email'];


$id = $admin->getEmailUser('id', $email_get);

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
$email = $admin->getEmailUser('email', $email_get);
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
                <li><a href="hub-test">На главную</a></li>
                <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo $_SESSION['user'][1] ?><i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="profile">Профиль</a></li>
                <li><a href="?out">Выход</a></li>
            </ul>
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="profile">Профиль</a></li>
                <li><a href="?out">Выход</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row background-user z-depth-2" style="padding: 40px">
        <h4>Создание нового пароля</h4>
        <form action="confirmation_password?email=<?php echo $email ?>" method="post" class="col s12">
            <blockquote>
                Пароль должен быть длиннее 6 символов.
            </blockquote>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="password" name="new_password" type="password" class="validate" required>
                    <label for="password">Новый пароль</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="password" name="rep_new_password" type="password" class="validate" required>
                    <label for="password">Повторите новый пароль</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button class="btn waves-effect waves-light blue-grey darken-4 white-text" type="submit" name="action">Поменять пароль
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