<?php
namespace app;
use mysql;
class Author extends UserObject {

    public function create_json($file_txt_upload,$name_tets,$text_test,$difficult) {
        $keyarray = ["ans1", "ans2", "ans3", "ans4", "ans5"];
        $array = file($file_txt_upload);
        foreach ($array as $key => $value) {
            $temparray = preg_split( '/ {2,}/', $value);
            $namebook = array_shift($temparray);
            $books[$namebook] = array_combine($keyarray, $temparray);

        }
        $file_json_encode = json_encode($books);
        $file = "views_test/json-file/".uniqid() . '_' . date("m.d.y"). "_" . $name_tets .".json";
        if (!file_exists($file)) {
            $fcreate = fopen($file, "w");
            fwrite($fcreate, $file_json_encode);
            fclose($fcreate);
        }
        $result_file_name = mb_substr( $file, 21);
        $this->add_json_name($name_tets,$result_file_name,$text_test,$difficult);
    }

    public function add_json_name($name_tets,$result_file_name,$text_test,$difficult) {
        return parent::query("INSERT INTO `out_test` (title,text,difficult,image,file_name) VALUES ('$name_tets','$text_test','$difficult','js.png','$result_file_name')");
    }

    public function uploadFile($name_tets,$text_test,$difficult,$file_json) {
        $extension = pathinfo($file_json['name'], PATHINFO_EXTENSION);
        $file_txt_upload = 'views_test/txt-file/'.uniqid()  . '_' . date("m.d.y") . "_" . $name_tets . "." . $extension;
        move_uploaded_file($file_json['tmp_name'], $file_txt_upload);

        $this->create_json($file_txt_upload,$name_tets,$text_test,$difficult);
        header('Location: /');
        return $file_txt_upload;
    }
}
