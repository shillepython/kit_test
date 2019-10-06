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
use app\UserObject;
use app\Admin;

$connection = new User();
$admin = new Admin();
$user = new UserObject();

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
<?php if($admin->getElementsTable('role_id',$id) == 1):
    require "../layouts/navbar.php";
?>

<!--<div class="container">-->
<!--    <h2>Все тесты:</h2>-->
<!---->
<!--    <hr>-->
<!--    <div class="row cards-top">-->
<!--        --><?php
//        $testing = "SELECT * FROM `users`";
//        while ($test = $testing->fetch_assoc()) {
//            ?>
<!--            <div class="col s12 m4">-->
<!--                <div class="card">-->
<!--                    <div class="card-image">-->
<!--                        <img src="/public/img/test/--><?php //echo $test['img']; ?><!--">-->
<!--                        <span class="card-title">-->
<!--                        --><?php //echo $test['title']; ?>
<!--                    </span>-->
<!--                    </div>-->
<!--                    <div class="card-content">-->
<!--                        --><?php //echo $test['short_text']; ?>
<!--                    </div>-->
<!--                    <div class="card-action">-->
<!--                        <a href="../testing/test.php?id=--><?php //echo $test['id'] ?><!--">Пройти тест</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            --><?php
//        }
//        ?>
<!--    </div>-->
<!--</div>-->
<?php elseif($admin->getElementsTable('role_id',$id) == 2):
    require "../layouts/authornav.php";
?>
    <div class="container">
        <div class="row z-depth-2 profil-text">
            <div class="col s12">
                <h5>Панель управление пользователями</h5>
                <div class="row s12">
                    <div class="col s6">
                        <a href="create-test/add.php" class="waves-effect waves-light btn-large">Создать тест</a>
                    </div>
                    <div class="col s6">
                        <a href="admin-groups.php" class="waves-effect waves-light btn-large">Поиск групп</a>
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
                <h5>Панель управление пользователями</h5>
                <div class="row s12">
                    <div class="col s4">
                        <a href="admin-user.php" class="waves-effect waves-light btn-large">Таблица пользователей</a>
                    </div>
                    <div class="col s4">
                        <a href="admin-groups.php" class="waves-effect waves-light btn-large">Поиск групп</a>
                    </div>
                    <div class="col s4">
                        <a href="create-test/add.php" class="waves-effect waves-light btn-large">Создать тест</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>


<?php require "../layouts/footer.php"?>
