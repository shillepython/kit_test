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
    header('Location: admin-user');
}
$id = $_SESSION['user'][0];

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
if (isset($_POST['action'])){
    $name_search = trim($_POST['search']);
}

?>

<?php if($admin->getElementsTable('role_id',$id) == 3):?>


<?php require "../layouts/adminnav.php"; ?>
    <div class="fixed-action-btn vertical click-to-toggle">
        <a class="btn-floating btn-large red darken-2">
            <i class="material-icons">menu</i>
        </a>
        <ul>
            <li>
                <a href="download-user" class="btn-floating cyan darken-2"><i class="material-icons">file_download</i></a>
            </li>
        </ul>
    </div>
    <div id="test1" class="col s12">
        <h5>Все зарегестрированые пользователи</h5>

        <?php if(!empty($name_search)):?>
            <table>
                <thead>
                <tr>
                    <th>Логин</th>
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
            <form action="admin-user" method="post">
                <input name="search" placeholder="Введите логин пользователя" type="text" required>
                <button class="btn waves-effect waves-light cyan darken-2 white-text" type="submit" name="action">Поиск
                    <i class="material-icons right">send</i>
                </button>

            </form>
            <thead>
            <tr>
                <th>Логин</th>
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
                <td><?php  echo $user[3]; ?></td>
                <td><?php  echo $user[4]; ?></td>
                <td><?php  echo $user[5]; ?></td>
                <td><?php  echo $user[6]; ?></td>
                <td><?php  echo $user[9]; ?></td>
                <td><?php  echo $user[10]; ?></td>
                <td><?php  echo $user[11]; ?></td>
                <td>
                <?php  if($user[12] == '3') {
                    echo 'админ';
                }if ($user[12] == '2'){
                    echo 'автор';
                }if ($user[12] == '1'){
                    echo 'пользователь';
                }
                ?></td>
                <td><a href="edit/<?php echo $user[0]; ?>" class="btn-user"><i class="material-icons left">edit</i></a></td>
                <td><a href="?del_user=<?php echo $user[0]; ?>"><i class="material-icons left">remove_circle_outline</i></a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>

<?php require "../layouts/footer.php"?>