<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../../../../../public/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="../../../../../public/css/style.css">
    <title>Kit Test</title>
</head>
<body>
<nav>
    <div class="container">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center"><img src="http://kitit.com.ua/wp-content/uploads/2018/12/cropped-logo_kit_w-1.png" width="65" height="65" alt=""></a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/resources/views/account/hub-test">Панель управления</a></li>
                <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo $_SESSION['user'][1] ?><i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="/resources/views/account/profile">Профиль</a></li>
                <li><a href="/resources/views/account/hub-test">Панель</a></li>
                <li><a href="?out">Выход</a></li>
            </ul>
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="/resources/views/account/profile">Профиль</a></li>
                <li><a href="/resources/views/account/hub-test">Панель</a></li>
                <li><a href="?out">Выход</a></li>
            </ul>
        </div>
    </div>
</nav>

