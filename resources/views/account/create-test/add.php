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

require "../../../../app/Connection.php";
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


if (isset($_POST['action'])) {
    $user->uploadFile(trim($_POST['name_test']),$_FILES['file']);
}
?>
<?php if($user->dateUser($id,10) == 3):?>


    <?php require "../../layouts/adminnav.php"; ?>
    <div class="container center-align">
        <form action="?" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="first_name" name="name_test" type="text" class="validate" required>
                    <label for="first_name">Название теста</label>
                </div>
            </div>
            <div class="file-field input-field">
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Отправить
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>

<?php endif; ?>

<?php require "../../layouts/footer.php"?>

