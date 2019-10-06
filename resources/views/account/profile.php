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
$connection = new User();
$user = new UserObject();
$id = $_SESSION['user'][0];
if ($user->dateUser($id,1) == ''){
    session_destroy();
    if (!isset($_SESSION['user'])){
        header('Location: /');
        exit();
    }
}
?>

<?php if($user->dateUser($id,10) == 1): ?>

    <?php require "../layouts/navbar.php"; require "profile-user.php"; ?>

<?php elseif($user->dateUser($id,10) == 2):?>

    <?php require "../layouts/navbar.php"; require "profile-teacher.php"; ?>

<?php elseif($user->dateUser($id,10) == 3):?>

    <?php require "../layouts/adminnav.php"; require "profile-admin.php"; ?>

<?php endif; ?>


<?php require "../layouts/footer.php"?>
