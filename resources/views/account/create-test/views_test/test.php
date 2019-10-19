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
?>

<?php if($admin->getElementsTable('role_id',$id) == 1):?>

    <?php require "../../../layouts/navbar.php"; ?>
    
    <p class="container button-run center-align">
        <button class="waves-effect waves-light btn-large test-run  blue-grey darken-4 white-text" style="margin-top: 20px;">Начать тест</button>
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

 <?php $result_file_name = $admin->getTestTable('file_name', $idGet); ?>;

<?php require "../../../layouts/footer.php" ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    /*$(document).ready(function () {
        $("button").click(function () {
            $.getJSON("json_question/json_question_5dab4ccf4ad7f.json", function (data, textStatus, jqXHR) {
                $.each(data, function (i, field) {
                    $("div.tests").append('<div class="col s12" id="'+ i +'">');
                    $("div#"+i+".col.s12").append("<h4>" + i + "</h4>");
                    $.each(field, function (k, v) {
                        $("div#"+i+".col.s12").append("<p>" + k + "</p>");
                        $("div#"+i+".col.s12").append("<p>" + v + "</p>");
                    });
                });
            });
        });
    });*/
    $(document).ready(function() {
        $("button").click(function() {
            // задаем функцию при нажатиии на элемент <button>
            $.getJSON("json_question/json_question_5dab4ccf4ad7f.json", function(data, textStatus, jqXHR) {

                // указываем url и функцию обратного вызова;
                let qstr = "";
                let group_number = 0;
                let test_id = 0;

                for (let key in data) {
                    let answ_number = 0;
                    qstr +=
                        '<div class="row tests z-depth-2"><div class="col s12">' +
                        "<h4>" +
                        key +
                        "</h4>";
                    let arr = data[key];
                    for (let i = 0; i < arr.length; i++){
                        qstr +=
                            "<p> <input name='group" +
                            group_number +
                            "' type='radio' id='test" +
                            test_id +
                            "' /><label for='test" +
                            test_id +
                            "'>" +
                            arr[i].replace("<", "&lt;"); +
                            "</label></p>";
                        answ_number++;
                        test_id++;
                    }
                    qstr += "</div></div>";
                    group_number++;
                }
                // tests.push(qstr);
                $("<form/>", {
                    id: "finish_test",
                    class: "my-new-list",
                    html: qstr,
                    action: 'dateProcessing',
                    method: 'POST'
                }).appendTo(".tests");
                $('#finish_test').append('<button type="submit" class="waves-effect waves-light btn-large test-run">Завершить тест</button>');
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
