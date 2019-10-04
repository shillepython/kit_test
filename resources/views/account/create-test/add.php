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
    function uploadFile($file_json)
    {
        $extension = pathinfo($file_json['name'], PATHINFO_EXTENSION);
        $file_txt_upload = 'txt-file/'.uniqid()  . '_' . date("m.d.y") . "." . $extension;
        move_uploaded_file($file_json['tmp_name'], $file_txt_upload);

        $file_read_txt = file($file_txt_upload);
        $file_json = json_encode($file_read_txt);
        $file = 'json-file/'.uniqid() . '_' . date("m.d.y").".json";
        if (!file_exists($file)) {
            $fcreate = fopen($file, "w");
            fwrite($fcreate, $file_json);
            fclose($fcreate);
        }

        return $file_txt_upload;
    }
    $filename = uploadFile($_FILES['file']);


}
?>

<?php if($user->dateUser($id,10) == 3):?>


    <?php require "../../layouts/adminnav.php"; ?>
    <div class="container center-align">
        <form action="?" method="post" enctype="multipart/form-data">
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

