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

require "../../../autoload.php";
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

    <?php require "../layouts/navbar.php"; ?>
    <p class="container center-align">
        <button>Открыть тест</button>
    </p>
<div class="container">
    <div class="test">
        <div class="row">
            <div class="col s12 tests">
                <h4>Тест: <?php echo $testing = $user->getTestTable('title',$idGet); ?></h4>
            </div>

        </div>
    </div>
</div>

<?php require "../layouts/footer.php"?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $( document ).ready(function() {
        $( "button" ).click(function() { // задаем функцию при нажатиии на элемент <button>
            $.getJSON( "test_html.json", function ( data, textStatus, jqXHR ) { // указываем url и функцию обратного вызова;
                let tests = [];
                for (let key in data ) {
                    let ans1 = 1;
                    let ans2 = 2;
                    let ans3 = 3;
                    let ans4 = 4;
                    tests.push('<div class="row tests-bg z-depth-2"><div class="col s12">'
                    + "<h4>" +key+ "</h4>"
                    + "<p> <input name='group1' type='radio' id="+ "'" + ans1 + 1 + "'" +" /><label for="+ "'" + ans1 + "'" +">" + data[key]['ans1'] + "</label></p>"
                    + "<p> <input name='group1' type='radio' id="+ "'" + ans2 + 2 + "'" +"  /><label for="+ "'" + ans2 + "'" +">" + data[key]['ans2'] + "</label></p>"
                    + "<p> <input name='group1' type='radio' id="+ "'" + ans3 + 3 + "'" +"  /><label for="+ "'" + ans3 + "'" +">" + data[key]['ans3'] + "</label></p>"
                    + "<p> <input name='group1' type='radio' id="+ "'" + ans4 + 4 + "'" +"  /><label for="+ "'" + ans4 + "'" +">" + data[key]['ans4'] + "</label></p>"
                    + "</div></div>");
                };
                $('<form/>', {
                    'class': 'my-new-list',
                    html: tests.join('')
                }).appendTo('.tests');
            })
        })
    });
</script>

