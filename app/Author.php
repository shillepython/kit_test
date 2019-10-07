<?php
namespace app;
use mysql;
class Author extends UserObject {
    public function create_json($file_txt_upload,$name_tets) {
        $keyarray = ["ans1", "ans2", "ans3", "ans4", "ans5"];
        $array = file($file_txt_upload);
        foreach ($array as $key => $value) {
            $temparray = preg_split( '/ {2,}/', $value);// разделить строку по двум и более пробелам / {2,}/g
            $namebook = array_shift($temparray); // извлекаем название книги и укорачиваем массив на один элемент
            $books[$namebook] = array_combine($keyarray, $temparray); // склеиваем массив с ключами и новый массив

        }
        $file_json_encode = json_encode($books);
        $file = 'json-file/'.uniqid() . '_' . date("m.d.y"). "_" . $name_tets .".json";
        if (!file_exists($file)) {
            $fcreate = fopen($file, "w");
            fwrite($fcreate, $file_json_encode);
            fclose($fcreate);
        }
    }

    public function uploadFile($name_tets,$file_json) {
        $extension = pathinfo($file_json['name'], PATHINFO_EXTENSION);
        $file_txt_upload = 'txt-file/'.uniqid()  . '_' . date("m.d.y") . "_" . $name_tets . "." . $extension;
        move_uploaded_file($file_json['tmp_name'], $file_txt_upload);

        $this->create_json($file_txt_upload,$name_tets);
        header('Location: /');
        return $file_txt_upload;
    }
}
