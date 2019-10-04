<?php
session_start();
if (isset($_GET['out'])){
    header('Location: /');
    session_destroy();
}
if (!isset($_SESSION['user'])){
    header('Location: /');
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
    <link type="text/css" rel="stylesheet" href="/public/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="/public/css/style.css">
    <title>Kit Test</title>
    <style>
        body {
            background-color: #fff;
        }
    </style>
</head>
<body>

<nav>
    <div class="container">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo center"><img src="http://kitit.com.ua/wp-content/uploads/2018/12/cropped-logo_kit_w-1.png" width="65" height="65" alt=""></a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="/resources/views/account/hub-test.php">На главную</a></li>
                <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><?php echo $_SESSION['user'][1] ?><i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="/resources/views/account/profile.php">Профиль</a></li>
                <li><a href="?out">Выход</a></li>
            </ul>
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="/resources/views/account/profile.php">Профиль</a></li>
                <li><a href="?out">Выход</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php
require "../../../app/Connection.php";
use app\Connection;
$connection = new Connection();
?>
<?php if($_SESSION['user' ][6] == 'пользователь'): ?>
    <div class="container">
        <?php
            $test = $connection->query("SELECT * FROM `article_tests` WHERE `id`= " . (int) $_GET['id']);
            $test_row = $test->fetch_assoc();
            if ($test->num_rows <= 0){
               ?>
                <h2>Тест не найден</h2>
               <?php
            }else{
                ?>
                <h3 class="title-test">Тест по: <?php echo $test_row['title']?></h3>
                <div class="row">
                    <form action="#">
                        <div class="col s12">
                            <?php
                            $quesions = $connection->query("SELECT * FROM `article_tests` WHERE `id`= " . (int) $_GET['id']);
                            while ($ques = $quesions->fetch_assoc()) {
                                ?>
                            <div class="row z-depth-1 bg-test">
                                <div class="col s12">
                                        <h5>1. Что такое HTML?</h5>
                                        <p>
                                            <input name="ans1" type="radio" id="answer1"/>
                                            <label for="answer1"><?php echo $ques['ques1-1']; ?></label>
                                        </p>
                                        <p>
                                            <input name="ans1" type="radio" id="answer2"/>
                                            <label for="answer2"><?php echo $ques['ques1-2']; ?></label>
                                        </p>
                                        <p>
                                            <input name="ans1" type="radio" id="answer3"/>
                                            <label for="answer3"><?php echo $ques['ques1-3']; ?></label>
                                        </p>
                                </div>
                            </div>
                                <?php } ?>
                        </div>
                    </form>
                </div>

                <?php } ?>
    </div>
<?php elseif($_SESSION['user' ][6] == 'преподаватель'):?>

    <p>Привет преподователь </p>

<?php elseif($_SESSION['user' ][6] == 'администратор'):?>

    <p>Привет администратор </p>

<?php endif; ?>


<?php require "../layouts/footer.php"?>
