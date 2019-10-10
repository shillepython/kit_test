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

    <?php require "../../../layouts/navbar.php"; ?>
    <p class="container button-run center-align">
        <button class="waves-effect waves-light btn-large test-run">Начать тест</button>
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

<?php require "../../../layouts/footer.php" ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $( document ).ready(function() {
        $( "button" ).click(function() {
            $(this).closest("button").remove();
            $.getJSON( "json-file/5d9f9410a024c_10.10.19_HTML.json", function ( data) {
                let tests = [];
                for (let key in data ) {
                    let ans1 = 1;
                    let ans2 = 2;
                    let ans3 = 3;
                    let ans4 = 4;
                    for(let i = 0; i < Object.keys(data).length - Object.keys(data).length + 1; i++){
                        tests.push('<div class="row tests-bg z-depth-2"><div class="col s12">'
                        + "<h4>" +key+ "</h4>"
                        + "<p> <input name='group1' type='radio' id="+ "'" + i + "'" +" /><label for="+ "'" + ans1 + "'" +">" + data[key]['ans1'] + "</label></p>"
                        + "<p> <input name='group1' type='radio' id="+ "'" + i + "'" +"  /><label for="+ "'" + ans2 + "'" +">" + data[key]['ans2'] + "</label></p>"
                        + "<p> <input name='group1' type='radio' id="+ "'" + i + "'" +"  /><label for="+ "'" + ans3 + "'" +">" + data[key]['ans3'] + "</label></p>"
                        + "<p> <input name='group1' type='radio' id="+ "'" + i + "'" +"  /><label for="+ "'" + ans4 + "'" +">" + data[key]['ans4'] + "</label></p>"
                        + "</div></div>");
                    }
                };
                $('<form/>', {
                    'class': 'form-testing',
                    html: tests.join('')
                }).appendTo('.tests');

            })
        })
    });
</script>

