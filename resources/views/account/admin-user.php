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

$user = new UserObject();
$connection = new User();
$admin = new Admin();

if (isset($_GET['del_user'])) {
    $id_user = $_GET['del_user'];
    $admin->deleteUser($id_user);
    header('Location: admin-user.php');
}
$id = $_SESSION['user'][0];

if ($admin->getElementsTable('login',$id) == ''){
    session_destroy();
    if (!isset($_SESSION['user'])){
        header('Location: /');
        exit();
    }
}

$name_search = trim($_POST['search']);


?>

<?php if($admin->getElementsTable('role_id',$id) == 3):?>


<?php require "../layouts/adminnav.php"; ?>
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
                    <th>Регистрация</th>
                    <th>Группа</th>
                    <th>Роль</th>
                </tr>
                </thead>
                <tbody>
                <?php $admin->searchUser($name_search); ?>
                </tbody>
            </table>
        <?php endif; ?>
        <table class="highlight">
            <form action="admin-user.php" method="post">
                <input name="search" placeholder="Введите логин пользователя" type="text" required>
                <button class="btn waves-effect waves-light" type="submit" name="action">Поиск
                    <i class="material-icons right">send</i>
                </button>

            </form>
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
                <th>Править</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $users = $admin->AllTable();
            $roles = $admin->roleTable();
            $rolesUser = $roles->fetch_row();
            while ($user = $users->fetch_row()) {
            ?>
            <tr>
                <td><?php  echo $user[1]; ?></td>
                <td><?php  echo $user[2]; ?></td>
                <td><?php  echo $user[3]; ?></td>
                <td><?php  echo $user[4]; ?></td>
                <td><?php  echo $user[5]; ?></td>
                <td><?php  echo $user[6]; ?></td>
                <td><?php  echo $user[7]; ?></td>
                <td><?php  echo $user[8]; ?></td>
                <td><?php  echo $user[9]; ?></td>
                <td>
                <?php  if($user[10] == '3') {
                    echo 'админ';
                }if ($user[10] == '2'){
                    echo 'автор';
                }if ($user[10] == '1'){
                    echo 'пользователь';
                }
                ?></td>
                <td><a href="edit/edit.php?id=<?php echo $user[0]; ?>" class="btn-user"><i class="material-icons left">edit</i></a></td>
                <td><a href="?del_user=<? echo $user[0]; ?>"><i class="material-icons left">remove_circle_outline</i></a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>

<?php require "../layouts/footer.php"?>