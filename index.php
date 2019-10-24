<?php
session_start();
use app\UserObject;
include "autoload.php";
$userObj = new UserObject();
if (isset($_SESSION['user'])){
    header("Location: hub-test");
    exit();
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
    <link type="text/css" rel="stylesheet" href="public/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="public/css/style.css">
    <title>Kit Test</title>
</head>
<body>
<nav class="cyan lighten-2">
    <div class="container">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center"><img src="http://kitit.com.ua/wp-content/uploads/2018/12/cropped-logo_kit_w-1.png" width="65" height="65" alt=""></a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="http://kitit.com.ua/">kitit.com.ua</a></li>
            </ul>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/">Registation</a></li>
                <li><a href="signin">Sign in</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="http://kitit.com.ua/">kitit.com.ua</a></li>
                <li><a href="/">Registation</a></li>
                <li><a href="signin">Sign in</a></li>
            </ul>
        </div>
    </div>
</nav>
    <div class="container center-align">
        <div class="row background-reg z-depth-2">
            <form action="config/auth" method="post" class="col s12">
                <h4>Регистрация аккаунта</h4>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="first_name" name="name" type="text" class="validate" required>
                        <label for="first_name">Ваше имя</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="last_name" name="surname" type="text" class="validate" required>
                        <label for="last_name">Ваша фамилия</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">face</i>
                        <input id="login" name="login" type="text" class="validate" required>
                        <label for="login">Введите ваш логин</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input id="email" name="email" type="email" class="validate" required>
                        <label for="email">Ваша почта</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">date_range</i>
                        <input type="text" name="date" class="validate" placeholder="00.00.0000" required>
                        <label for="date">Ваша дата рождения</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input id="phone" type="text" name="phone" id="phoneNumber" data-inputmask-clearmaskonlostfocus="false" class="validate"  placeholder="+380" required>
                        <label for="phone">Ваш телефон</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" name="password" type="password" class="validate" required>
                        <label for="password">Ваш пароль</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <button class="btn waves-effect waves-light cyan darken-2 white-text" type="submit" name="action">зарегистрироваться
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="public/js/materialize.min.js"></script>
<script src="node_modules/inputmask/dist/inputmask/bindings/inputmask.binding.js"></script>
<script>
    $( document ).ready(function(){
        $(".button-collapse").sideNav();
    })
</script>
</body>
</html>
