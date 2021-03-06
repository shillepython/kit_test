<?php
session_start();
if (isset($_SESSION['user'])){
    header('Location: ../hub-test');
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
    <link type="text/css" rel="stylesheet" href="../../../public/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="../../../public/css/style.css">
    <title>Kit Test</title>
</head>
<body>
<nav>
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
                <li><a href="resources/views/signin/signin">Sign in</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    <div class="row background-user z-depth-2" style="padding: 20px;">
        <form action="../../../config/signin" method="post" class="col s12">
            <h4>Авторизация</h4>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">face</i>
                    <input id="login" name="login" type="text" class="validate">
                    <label for="login">Ваш логин</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="password" name="password" type="password" class="validate">
                    <label for="password">Ваш пароль</label>
                </div>
                <a style="margin-left: 60px;" href="recovery-password">Забыл пароль</a>
            </div>
            <div class="row">
                <div class="col s12">
                    <button class="btn waves-effect cyan darken-2 waves-light white-text" type="submit" name="action">вход
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/public/js/materialize.min.js"></script>

<script>
    $( document ).ready(function(){
        $(".button-collapse").sideNav();
    })
</script>
</body>
</html>
