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
use app\User;
use app\Admin;

$user = new User();
$admin = new Admin();

echo $admin->editTests(15);
$title = $_POST['title_test'];
if (isset($_GET['del_user'])) {
    $id_user = $_GET['del_user'];
    $admin->deleteUser($id_user);
}
$id = $_SESSION['user'][0];


$arr = str_replace("<", "&lt;", $_POST);
$array_answer = [];
$sql = $admin->query("SELECT * FROM `ans_question` WHERE name_test='$title'");
while ($test = $sql->fetch_assoc()){
    $test_rep = str_replace("<", "&lt;", $test['ans']);
    array_push($array_answer, $test_rep);
}

$arr_post = [];
for ($i = 0; $i < 12; $i++){
    array_push($arr_post, $arr['group' . $i]);
}

$true_ans = 0;
$false_ans = 0;

for ($i = 0; $i < 12; $i++){
    if (substr($arr_post[$i], 0) != substr($array_answer[$i], 0)) {
        $false_ans++;
    } else {   // иначе
        $true_ans++;
    }
}
echo "Правильный ответов: ".$true_ans . "\nНе правильный ответов: ". $false_ans;
