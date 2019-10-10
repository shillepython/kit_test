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

require "../../../../autoload.php";
use app\Author;
use app\Admin;

$author = new Author();
$admin = new Admin();

$id = $_SESSION['user'][0];

if ($admin->getElementsTable('login',$id) == ''){
    session_destroy();
    if (!isset($_SESSION['user'])){
        header('Location: /');
        exit();
    }
}

if (isset($_POST['action'])) {
    $name_test = trim($_POST['name_test']);
    $text_test = trim($_POST['text_test']);
    $difficult = trim($_POST['difficult']);

    $file = $_FILES['file'];
    $json = $author->uploadFile($name_test,$text_test,$difficult,$file);
}
?>
<?php if($admin->getElementsTable('role_id',$id) == 3 || $admin->getElementsTable('role_id',$id) == 2):?>
    <?php require "../../layouts/adminnav-add.php"; ?>
    <div class="container center-align">
        <form action="?" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="first_name" name="name_test" type="text" class="validate" required>
                    <label for="first_name">Название теста</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="text_test" name="text_test" type="text" class="validate" required>
                    <label for="text_test">Описание теста</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">recent_actors</i>
                    <select name="difficult">
                        <option value="easy">easy</option>
                        <option value="middle">middle</option>
                        <option value="senior">senior</option>
                    </select>
                    <label>Сложность теста</label>
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

