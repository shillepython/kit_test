<?php

session_start();
if (isset($_GET['out'])) {
    header('Location: /');
    session_destroy();
}
if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit();
}
require "../../../../autoload.php";

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

if ($admin->getElementsTable('verefy', $id) != 1) {
    header("Location: /");
}


if ($admin->getElementsTable('login', $id) == '') {
    session_destroy();
    if (!isset($_SESSION['user'])) {
        header('Location: /');
        exit();
    }
}

if ($admin->getElementsTable('role_id', $id) == 3):
  $admin->download_user_file();
?>
<?php else:
    header("Location: ../hub-test");
?>

<?php endif;?>