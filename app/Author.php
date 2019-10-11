<?php
namespace app;
use mysql;
class Author extends UserObject {

    public function create_json($file_txt_upload,$name_tets,$text_test,$file_image_ret,$difficult) {
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
        $this->add_json_name($name_tets,$result_file_name,$text_test,$file_image_ret,$difficult);

        $dir    = 'views_test/json-file/';
        $files1 = scandir($dir);

        $file_total = [];
        for($i = 2; $i <= count($files1) - 1; $i++){
            $filename = "views_test/json-file/".$files1[$i];
            $handle = fopen($filename, "r");
            $file_total_text = ($contents = fread($handle, filesize($filename)));
            array_push($file_total,$file_total_text);
            fclose($handle);
        }
        $fp = fopen("views_test/total_test/total_test.json", "w");
        fwrite($fp, implode(",", $file_total));
        fclose($fp);
    }

    public function add_json_name($name_tets,$result_file_name,$text_test,$file_image_ret,$difficult) {
        return parent::query("INSERT INTO `out_test` (title,text,difficult,image,file_name) VALUES ('$name_tets','$text_test','$difficult','$file_image_ret','$result_file_name')");
    }
    public function uploadImage($file_image) {
        $path = "../../../../public/img/test/";
        move_uploaded_file($file_image['tmp_name'], $path . $file_image['name']);
        return $file_image['name'];
    }
    public function uploadFile($name_tets,$text_test,$file_image,$difficult,$file_json) {
        $extension = pathinfo($file_json['name'], PATHINFO_EXTENSION);
        $file_txt_upload = 'views_test/txt-file/'.uniqid()  . '_' . date("m.d.y") . "_" . $name_tets . "." . $extension;
        move_uploaded_file($file_json['tmp_name'], $file_txt_upload);
        $file_image_ret = $this->uploadImage($file_image);
        $this->create_json($file_txt_upload,$name_tets,$text_test,$file_image_ret,$difficult);
        header('Location: /');
        return $file_txt_upload;
    }
}
