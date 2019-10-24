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
require "../../../autoload.php";
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

if ($id == null){
    echo 'Такая почта, или логин уже существует!';
    echo "<a href='/'>на страницу регистрации</a>";
}
if ($admin->getElementsTable('login',$id) == ''){
    session_destroy();
    if (!isset($_SESSION['user'])){
        header('Location: /');
        exit();
    }
}

if (isset($_GET['token'])){
    $token = $_GET['token'];
    if (!empty($token)){
        if ($token == $admin->getElementsTable('token',$id)){
            $email = $admin->getElementsTable('email',$id);

            $id = $admin->getEmailUser('id', $email);
            $login = $admin->getEmailUser('login', $email);
            $password = $admin->getEmailUser('password', $email);
            $name = $admin->getEmailUser('name', $email);
            $surname = $admin->getEmailUser('surname', $email);
            $date = $admin->getEmailUser('birth_date', $email);
            $email_row = $admin->getEmailUser('email', $email);
            $token = 'true';
            $verefy = 1;
            $phone = $admin->getEmailUser('tel', $email);
            $date_registartion = $admin->getEmailUser('registration_date', $email);
            $group = $admin->getEmailUser('group_id', $email);
            $role = $admin->getEmailUser('role_id', $email);
            $admin->updateUser($id,$login,$password,$name,$surname,$date,$email_row,$token,$verefy,$phone,$date_registartion,$group,$role);
            header("Location: hub-test");
        }else{
            return;
        }
    }
}


if ($admin->getElementsTable('verefy',$id) != 1):
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
    <div class="container">
        <div class="row background-user z-depth-2" style="padding: 40px">
            <h4>Подтверждение почты</h4>
            <div class="row">
                <div class="input-field col s12">
                    Подтвердите свою <a href="https://gmail.com">почту</a> чтобы пользоваться сервисом.
                </div>
            </div>
            <a href="?out" class="btn blue-grey darken-4 white-text">Выход</a>
        </div>
    </div>

<?php else: ?>

<?php if($admin->getElementsTable('role_id',$id) == 1):
    require "../layouts/navbar.php";
?>

<div class="container">
    <h2 style="border-bottom: 1px solid #000; padding-bottom: 20px">Все тесты:</h2>

    <div class="row cards-top">
        <?php
        $testing = $admin->out_test();
        while ($test = $testing->fetch_assoc()) {
            ?>
            <div class="col s12 xl4 m4">
                <div class="card">
                    <div class="card-image">
                        <img width="300px" height="300px" src="/public/img/test/<?php echo $test['image']; ?>">
                        <span class="card-title">
                        <?php echo $test['title']; ?>
                    </span>
                    </div>
                    <div class="card-content">
                        <?php echo $test['text']; ?>
                        <p><b>Уровень сложности: <?php echo $test['difficult']; ?></b></p>
                    </div>
                    <div class="card-action">
                        <a href="test?id=<?php echo $test['id'] ?>">Пройти тест</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php elseif($admin->getElementsTable('role_id',$id) == 2):
    require "../layouts/authornav.php"; ?>
    <div class="container">
        <div class="row z-depth-2 profil-text">
            <div class="col s12">
                <h5>Панель управление</h5>
                <div class="row s12">
                    <div class="col s12 l4 xl4" style="padding: 20px;">
                        <a href="create-test/add" class="waves-effect waves-light btn-large cyan darken-2 white-text">Создать тест</a>
                    </div>
                    <div class="col s12 l4 xl4" style="padding: 20px;">
                        <a href="admin-groups" class="waves-effect waves-light btn-large cyan darken-2 white-text">Поиск групп</a>
                    </div>
                    <div class="col s12 l4 xl4" style="padding: 20px;">
                        <a href="add" class="waves-effect waves-light btn-large cyan darken-2 white-text">Создать тест</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php elseif($admin->getElementsTable('role_id',$id) == 3):?>
    <?php require "../layouts/adminnav.php"; ?>
    <div class="container">
        <div class="row z-depth-2 profil-text">
            <div class="col s12">
                <h5>Панель управление</h5>
                <div class="row s12">
                    <div class="col s12 l4 xl4" style="padding: 20px;">
                        <a href="admin-user" class="waves-effect waves-light btn-large cyan darken-2 white-text">Таблица пользователей</a>
                    </div>
                    <div class="col s12 l4 xl4 " style="padding: 20px;">
                        <a href="admin-groups" class="waves-effect waves-light btn-large cyan darken-2 white-text">Поиск групп</a>
                    </div>
                    <div class="col s12 l4 xl4" style="padding: 20px;">
                        <a href="add" class="waves-effect waves-light btn-large cyan darken-2 white-text">Создать тест</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php endif; ?>


<?php require "../layouts/footer.php"?>
<?php endif; ?>