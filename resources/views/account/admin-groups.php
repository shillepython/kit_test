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

$connection = new User();
$user = new UserObject();

if (isset($_GET['del_user'])) {
    $id_user = $_GET['del_user'];
    $user->deleteUser($id_user);
    header('Location: admin-user.php');
}
$id = $_SESSION['user'][0];

if ($user->dateUser($id,1) == ''){
    session_destroy();
    if (!isset($_SESSION['user'])){
        header('Location: /');
        exit();
    }
}

$name_search = trim($_POST['search']);


?>
<?php if($user->dateUser($id,10) == 3):?>

    <?php require "../layouts/adminnav.php"; ?>
<div class="container">
    <div id="test1" class="col s12">
        <h5>Все зарегестрированые пользователи</h5>
        <?php if(!empty($name_search)):?>
        <table>
            <thead>
            <tr>
                <th>Логин</th>
                <th>Пароль</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>День рождения</th>
                <th>Почта</th>
                <th>Телефон</th>
                <th>Регестрация</th>
                <th>Группа</th>
                <th>Роль</th>
            </tr>
            </thead>
            <tbody>
                    <?php $user->searchUserGroup($name_search); ?>
            </tbody>
        </table>
    <?php endif; ?>
        <table class="highlight">
            <form action="admin-groups.php" method="post">
                <input name="search" placeholder="Введите название группы" type="text" required>
                <button class="btn waves-effect waves-light" type="submit" name="action">Поиск
                    <i class="material-icons right">send</i>
                </button>

            </form>
            <thead>
            <tr>
                <th>Логин</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Группа</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $users = $user->AllTable();
            while ($user = $users->fetch_row()) {
                ?>
                <tr>
                    <td><?php  echo $user[1]; ?></td>
                    <td><?php  echo $user[3]; ?></td>
                    <td><?php  echo $user[4]; ?></td>
                    <td><?php  echo $user[9]; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<?php require "../layouts/footer.php"?>