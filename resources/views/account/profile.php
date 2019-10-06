<?php
session_start();
if (isset($_GET['out'])){
    session_destroy();
    header('Location: /');
}
if (!isset($_SESSION['user'])){
    header('Location: /');
    exit();
}


require "../../../autoload.php";
use app\User;
use app\UserObject;
use app\Admin;

$connection = new User();
$user = new UserObject();
$admin = new Admin();

$id = $_SESSION['user'][0];
if ($admin->getElementsTable('login',$id) == ''){
    session_destroy();
    if (!isset($_SESSION['user'])){
        header('Location: /');
        exit();
    }
}
?>

<?php if($admin->getElementsTable('role_id',$id) == 1): ?>

    <?php require "../layouts/navbar.php"; require "profile-user.php"; ?>

<?php elseif($admin->getElementsTable('role_id',$id) == 2):?>

    <?php require "../layouts/authornav.php"; require "profile-teacher.php"; ?>

<?php elseif($admin->getElementsTable('role_id',$id) == 3):?>

    <?php require "../layouts/adminnav.php"; require "profile-admin.php"; ?>

<?php endif; ?>


<?php require "../layouts/footer.php"?>
