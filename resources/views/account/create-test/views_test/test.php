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
<div id="timer">
    <span class="minutes">0</span>:<span class="seconds">00</span>
</div>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <p>A bunch of text</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>
<div class="container">
    <div class="test">
        <div class="row">
            <div class="col s12 tests">
                <h4>Тест: <?php echo $testing = $admin->getTestTable('title',$idGet); ?></h4>

            </div>
        </div>

    </div>
    <div class="gohomehref">

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

                var endquesions = {}; //новый массив , в котором строиться рандомизированный массив с тестами
                function fix(arr){  //функция строит новый масив
                    var keys = Object.keys(data);
                    for (let i = 0 ; i < arr.length;i++){
                        endquesions[keys[arr[i]]] = data[keys[arr[i]]]
                    }
                }
                function mix(array) { //создаёт массив на основе которого строиться перемешаный
                    var randomquesion;
                    var auxiliary;
                    var newarr = [];
                    for (var i = array.length ; i > newarr.length ; i++) {
                        randomquesion = Math.floor(Math.random() * (array.length - 0) + 0);
                        auxiliary = randomquesion;
                        auxiliary += "";
                        if(newarr.length>=array.length){
                            return fix(newarr);
                        }
                        if (newarr.indexOf(auxiliary)==-1){
                            newarr.push(auxiliary);
                        }
                    }
                    return array;
                }

                function auxiliary(array) {
                    return mix(Object.keys(array));
                }
                function showlog(array){
                    console.log(array);
                }
                mixedarray = auxiliary(data);
                showlog(endquesions);




                // указываем url и функцию обратного вызова;
                let qstr = "";
                let email = '<?= $email ?>';
                let group_number = 0;
                let test_id = 0;
                // endquesions += Object.values(endquesions).splice(11);
                console.log(endquesions);

                        for (let key in endquesions) {
                            let answ_number = 0;
                            qstr +=
                                '<div class="row tests z-depth-2" style="border-radius: 5px; padding: 20px;"<div class="col s12">' +
                                "<h4>" +
                                key +
                                "</h4>";
                            let arr = endquesions[key];
                            for (let i = 0; i < arr.length; i++) {
                                $val_first = arr[i].replace("<", "&lt;");
                                $val = $val_first.replace(">", "&gt;");
                                qstr +=
                                    "<p> <input required value='" + $val + "' name='group" +
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



                function getTimeRemaining(endtime) {
                    var t = Date.parse(endtime) - Date.parse(new Date());
                    var seconds = Math.floor((t / 1000) % 60);
                    var minutes = Math.floor((t / 1000 / 60) % 60);
                    return {
                        'total': t,
                        'minutes': minutes,
                        'seconds': seconds
                    };
                }

                function initializeClock(id, endtime) {
                    var clock = document.getElementById(id);
                    var minutesSpan = clock.querySelector('.minutes');
                    var secondsSpan = clock.querySelector('.seconds');

                    function updateClock() {
                        var t = getTimeRemaining(endtime);
                        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                        if (t.total <= 0) {
                            clearInterval(timeinterval);
                            var $toastContent = $('<span>Время вышло</span>').add($('<button class="btn-flat toast-action">Закрыть</button>'));
                            Materialize.toast($toastContent, 10000);
                            $('#test').remove();
                            $('.gohomehref').append('<a href="../hub-test" class="waves-effect waves-light btn-large cyan darken-2 white-text">На главную</a>');
                        }
                    }

                    updateClock();
                    var timeinterval = setInterval(updateClock, 1000);
                }

                var deadline = new Date(Date.parse(new Date()) + 60 * 1000 * 60); // for endless timer
                initializeClock('timer', deadline);




                $('#test').append('<button type="submit" id="finishButton" class="waves-effect waves-light btn-large cyan darken-2 white-text">Завершить тест</button>');
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
