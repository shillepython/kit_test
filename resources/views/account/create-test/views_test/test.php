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

require "../../../../../autoload.php";
use app\Admin;
use app\User;

$admin = new Admin();
$user = new User();

$id = $_SESSION['user'][0];
$idGet = (int) $_GET['id'];

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

$email = $admin->getElementsTable('email',$id);
?>

<?php if($admin->getElementsTable('role_id',$id) == 1):?>

    <?php require "../../../layouts/navbar.php"; ?>
    
    <p class="container button-run center-align">
        <button class="waves-effect waves-light btn-large test-run cyan darken-2 white-text" style="margin-top: 20px;">Начать тест</button>
    </p>
<div class="container">
    <div class="test">
        <div class="row">
            <div class="col s12 tests">
                <h4>Тест: <?php echo $testing = $admin->getTestTable('title',$idGet); ?></h4>

            </div>
        </div>

    </div>
</div>

 <?php
    $result_file_name = $admin->getTestTable('file_name', $idGet);
    $dir_file = mb_substr( $result_file_name, 10);
    $dir_file_final = rtrim($dir_file, ".json");
 ?>

<?php require "../../../layouts/footer.php" ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $( document ).ready(function(){
        $(".button-collapse").sideNav();
    })
</script>
<script>
    $(document).ready(function() {
        $("button").click(function() {
            var file_name_res = '<?= $result_file_name ?>';
            var dir_file = '<?= $dir_file_final ?>';
            // задаем функцию при нажатиии на элемент <button>
            $(this).closest("button").remove();
            $.getJSON("total_test/" + dir_file + "/" + file_name_res, function(data, textStatus, jqXHR) {

                // указываем url и функцию обратного вызова;
                let qstr = "";
                let email = '<?= $email ?>';
                let group_number = 0;
                let test_id = 0;
                for (let key in data) {
                    let answ_number = 0;
                    qstr +=
                        '<div class="row tests z-depth-2" style="border-radius: 5px; padding: 20px;"<div class="col s12">' +
                        "<h4>" +
                        key +
                        "</h4>";
                    let arr = data[key];
                    for (let i = 0; i < arr.length; i++){
                        $val_first = arr[i].replace("<", "&lt;");
                        $val = $val_first.replace(">", "&gt;");
                        qstr +=
                            "<p> <input required value='"+ $val +"' name='group" +
                            group_number +
                            "' type='radio' id='test" +
                            test_id +
                            "' /><label for='test" +
                            test_id +
                            "'>" +
                            $val +
                            "</label></p>";
                        answ_number++;
                        test_id++;
                    }
                    qstr += "</div></div>";
                    group_number++;
                }
                $("<form/>", {
                    id: "test",
                    class: "my-new-list",
                    html: qstr,
                    action: 'dateProcessing?email=' + email,
                    method: 'POST'
                }).appendTo(".tests");
                $('#test').append('<button type="submit" class="waves-effect waves-light btn-large cyan darken-2 white-text">Завершить тест</button>');
                $('#test').append("<input type='hidden' name='title_test' value='<?php echo $admin->getTestTable('title',$idGet); ?>'>");
                $('#test').append("<input type='hidden' name='difficult' value='<?php echo $admin->getTestTable('difficult',$idGet); ?>'>");
                $('#test').append("<input type='hidden' name='theme' value='<?php echo $admin->getTestTable('text',$idGet); ?>'>");
                $(".button-collapse").sideNav();
            });
        });
    });
</script>
<?php elseif ($admin->getElementsTable('role_id',$id) == 2):
header("Location: ../../hub-test");
?>
<?php elseif ($admin->getElementsTable('role_id',$id) == 3):
header("Location: ../../hub-test");
?>
<?php endif; ?>
