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

include "../../../../autoload.php";

use app\User;
use app\UserObject;
use app\Admin;

$connection = new User();
$user = new UserObject();
$admin = new Admin();

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

$id_edit = $_GET['id'];
$sql_edit = $admin->getId($id_edit);
$result_sql = $sql_edit->fetch_row();

$login = $result_sql[1];
$password = $result_sql[2];
$name = $result_sql[3];
$surname = $result_sql[4];
$date = $result_sql[5];
$email = $result_sql[6];
$phone = $result_sql[7];
$date_registartion = $result_sql[8];
$group = $result_sql[9];

?>

<?php if($admin->getElementsTable('role_id',$id) == 3):?>


    <?php require "../../layouts/adminnav-edit.php"; ?>
    <div class="container center-align">
        <div class="row background-reg z-depth-2">
            <form action="../edit-update" method="post" class="col s12">
                <input type="hidden" name="id" value="<?php echo $id_edit ?>">
                <input type="hidden" name="date_registartion" value="<?php echo $date_registartion ?>">
                <h4>Редактирование пользователя</h4>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="first_name" name="name" type="text" value="<?php echo $name ?>" class="validate" required>
                        <label for="first_name">Имя</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="last_name" name="surname" type="text" value="<?php echo $surname ?>" class="validate" required>
                        <label for="last_name">Фамилия</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">face</i>
                        <input id="login" name="login" type="text" class="validate" value="<?php echo $login ?>" required>
                        <label for="login">Логин</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input id="email" name="email" type="email" value="<?php echo $email ?>" class="validate" required>
                        <label for="email">Почта</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">date_range</i>
                        <input type="text" name="date" class="validate" value="<?php echo $date ?>" placeholder="00.00.0000" required>
                        <label for="date">Дата рождения</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input id="phone" type="text" name="phone" class="validate" value="<?php echo $phone ?>" placeholder="+380" required>
                        <label for="phone">Телефон</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">group</i>
                        <input id="group" name="group" type="text" value="<?php echo $group ?>" class="validate" required>
                        <label for="group">Групаа</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">recent_actors</i>
                        <select name="role_select">
                            <option value="1">пользователь</option>
                            <option value="2">автор</option>
                            <option value="3">админ</option>
                        </select>
                        <label>Роль</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <button class="btn waves-effect waves-light" type="submit" name="action">отредактировать
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php endif; ?>

<?php require "../../layouts/footer.php"?>