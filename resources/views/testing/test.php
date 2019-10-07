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
            <div class="col s12">
                <h4>Тест: <?php echo $testing = $user->getTestTable('title',$idGet); ?></h4>
                <div class="row tests">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="first_name" name="name" type="text" class="validate" required>
                        <label for="first_name">Ваше имя</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="last_name" name="surname" type="text" class="validate" required>
                        <label for="last_name">Ваша фамилия</label>
                    </div>
                </div>
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
                    tests.push('<p>' + key + ": <br>" + data[key]['ans1'] + "<br>" + data[key]['ans2'] + "<br>" + data[key]['ans3'] + "<br>" + data[key]['ans4'] + "<br>" + data[key]['ans5'] + "</p>"); // добавляем в переменную все ключи объекта и их значения
                };
                $('<form/>', {
                    'class': 'my-new-list',
                    html: tests.join('')
                }).appendTo('.tests');
            })
        })
    });
</script>

