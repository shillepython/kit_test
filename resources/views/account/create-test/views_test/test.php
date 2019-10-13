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
        <button class="waves-effect waves-light btn-large test-run">Начать тест</button>
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
    $( document ).ready(function() {
        $( "button" ).click(function() {
            var file_name_res = '<?= $result_file_name ?>';
            $(this).closest("button").remove();
            $.getJSON( "json-file/" + file_name_res, function (data) {
                let tests = [];
                for (let key in data ) {
                    // for(let i = 0; i < Object.keys(data).length - Object.keys(data).length + 1; i++){
                    //     for (let j = 0; j < Object.keys(data[key]).length - Object.keys(data[key]).length + 1; j++) {
                        for (let test in key ) {
                            <?php
                            $name_unic1 = uniqid();
                            $name_unic2 = uniqid();
                            $name_unic3 = uniqid();
                            $name_unic4 = uniqid();
                            ?>
                            tests.push('<div class="row tests-bg z-depth-2"><div class="col s12">'
                            + "<h4>" + key + "</h4>"
                            + "<p> <input name='group1' type='radio' id= <?= $name_unic1 ?> /><label for= <?= $name_unic1 ?> >" + data[key]['ans1'] + "</label></p>"
                            + "<p> <input name='group1' type='radio' id= <?= $name_unic2 ?> /><label for= <?= $name_unic2 ?> >" + data[key]['ans2'] + "</label></p>"
                            + "<p> <input name='group1' type='radio' id= <?= $name_unic3 ?> /><label for= <?= $name_unic3 ?> >" + data[key]['ans3'] + "</label></p>"
                            + "<p> <input name='group1' type='radio' id= <?= $name_unic4 ?> /><label for= <?= $name_unic4 ?> >" + data[key]['ans4'] + "</label></p>"
                            + "</div></div>");
                        }
                    // }
                };
                $('<form>', {
                    'class': 'form-testing',
                    html: tests.join('')
                }).appendTo('.tests');

            })
        })
    });
</script>
<?php elseif ($admin->getElementsTable('role_id',$id) == 2):
header("Location: ../../hub-test");
?>
<?php elseif ($admin->getElementsTable('role_id',$id) == 3):
header("Location: ../../hub-test");
?>
<?php endif; ?>
