<?php
$file_txt = file('text.txt');
$file_json = json_encode($file_txt);
//$json = file_put_contents('filename.json', $file_json);
// file_get_contents('filename.json');
$file = uniqid() . '_' . date("m.d.y").".json";
if (!file_exists($file)) {
    $fcreate = fopen($file, "w");
    fwrite($fcreate, $file_json);
    fclose($fcreate);
}

