<?php
//$file_ans = fopen('json_ans/json_answer_5dab4ccf4b747.json', "r");
//$file_user = fopen('ans_user/gh56jfg56_html.json', "r");

$true_ans = 0;
$false_ans = 0;

$str_ans = json_decode('json_ans/json_answer_5dab4ccf4b747.json',true);
$str_user = json_decode('ans_user/gh56jfg56_html.json',true);
for ($i = 0; $i < 12; $i++){
    if (substr($str_ans, 0) != substr($str_user, 0)) {
        $false_ans++;
    } else {   // иначе
        $true_ans++;
    }
}
echo "Правильный ответов: ".$true_ans . "\nНе правильный ответов: ". $false_ans;
