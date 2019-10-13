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
use app\User;
use app\Admin;

$user = new User();
$admin = new Admin();

echo $admin->editTests(15);

if (isset($_GET['del_user'])) {
    $id_user = $_GET['del_user'];
    $admin->deleteUser($id_user);
}
$id = $_SESSION['user'][0];

if ($admin->getElementsTable('login',$id) == ''){
    session_destroy();
    if (!isset($_SESSION['user'])){
        header('Location: /');
        exit();
    }
}
?>

<?php if($admin->getElementsTable('role_id',$id) == 3 || $admin->getElementsTable('role_id',$id) == 2):?>

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
                <li><a href="/resources/views/account/create-test/views_test/tests-admin">Тесты</a></li>
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


<div class="container">
        <h2>Все тесты:</h2>

        <hr>
        <div class="row cards-top">
            <?php
            $testing = $admin->out_test();
            while ($test = $testing->fetch_assoc()) {
                ?>
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img  width="300px" height="300px" src="/public/img/test/<?php echo $test['image']; ?>">
                            <span class="card-title">
                        <?php echo $test['title']; ?>
                    </span>
                        </div>
                        <div class="card-content">
                            <?php echo $test['text']; ?>
                        </div>
                        <div class="card-action">
                            Что-бы пройти тест ваша учётная запись должна состоять как пользователь
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
<?php
else: header("Location: /");
endif;
?>


<?php require "../../../layouts/footer.php"?>
