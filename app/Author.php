<?php
namespace app;
use mysql;
class Author extends UserObject {
    public function add_ans_question($name_tets,$answer)
    {
        $this->query("DELETE FROM `ans_question` WHERE ans = '$answer' AND name_test = '$name_tets'");
        return $this->query("INSERT INTO `ans_question` (name_test,ans) VALUES ('$name_tets','$answer')");
    }
    public function getTableTest($name_test){
        $getGroup =  $this->query("SELECT `title` FROM `out_test` WHERE title='$name_test'");
        $row_ass = $getGroup->fetch_assoc();
        return $row_ass['title'];
    }
    public function create_json($file_txt_upload,$name_tets,$text_test,$file_image_ret,$difficult,$file_json) {
        header('Content-Type: application/json; charset=utf-8');
        ini_set("xdebug.var_display_max_children", -1);
        ini_set("xdebug.var_display_max_data", -1);
        ini_set("xdebug.var_display_max_depth", -1);

        $question_arr = [];
        $answer_arr = [];
        $file = fopen($file_txt_upload, "r"); // открываем файл на чтение

        $file_quest_dir = 'views_test/json_question/' .  uniqid() . '_'.strtoupper($name_tets).'.json';
        $this->verefy_file_json($file,$name_tets,$question_arr,$answer_arr,$file_quest_dir);

        $file_name_json_substr = mb_substr( $file_quest_dir, 39);
        $result_file_name = "total_test" . $file_name_json_substr;

        if(empty($this->getTableTest($name_tets))){
            $this->add_json_name($name_tets,$result_file_name,$text_test,$file_image_ret,$difficult);
        }

        $this->create_reletive_json_file($file_quest_dir);


    }

    public function file_exists_empty($file_quest_dir,$file_total,$file_name_json){
        //Создание файла который в себе хранит все тесты.
        $fp = fopen("views_test/total_test/total_test.json", "w");
        fwrite($fp, str_ireplace('"]},{"', '"],"', implode(",", $file_total)));
        fclose($fp);

        //Создание массива
        $strJsonFileContents = file_get_contents($file_quest_dir);// Получаем код файла
        $array = json_decode($strJsonFileContents, true); //Декодируем и получаем массив

        // Дописываем данные в конец файла.
        $fp = $this->fopen_file_totaltest($file_name_json, "a");
        fwrite($fp, json_encode($array, JSON_UNESCAPED_UNICODE));
        fclose($fp);

        //Делаем так чтобы все вопросы были через "],"
        $json_code_replace = $this->getDirTotal_test_file_in($file_name_json);// Получаем код файла
        $dir_total_json = str_ireplace('"]}{"', '"],"', $json_code_replace); //Заменяем символы
        //Записываем данные
        $fp = $this->fopen_file_totaltest($file_name_json, "w");
        fwrite($fp, $dir_total_json);
        fclose($fp);

        //Проверка на одинаковые вопросы. Если есть хоть один вопрос будет дургой, он добавляется в конец файла.
        $reload = $this->getDirTotal_test_file_in($file_name_json);// Получаем код файла
        $final_json_array = json_decode($reload, true);
        $this->verefy_repeat_question($file_name_json,$final_json_array);
    }

    public function getDirTotal_test_file_in($file_name_json){
        return file_get_contents("views_test/total_test/" . rtrim($file_name_json,".json") . "/total_test" . $file_name_json);
    }

    public function fopen_file_totaltest($file_name_json, $key){
        return fopen("views_test/total_test/" . rtrim($file_name_json,".json") . "/total_test" . $file_name_json, $key);
    }

    public function verefy_repeat_question($file_name_json,$final_json_array){
        $fp = $this->fopen_file_totaltest($file_name_json, "w");
        fwrite($fp, json_encode($final_json_array, JSON_UNESCAPED_UNICODE));
        fclose($fp);
    }

    public function file_exists_no_empty($file_quest_dir,$file_total,$file_name_json) {
        mkdir("views_test/total_test/" . rtrim($file_name_json,".json"));

        $fp = fopen("views_test/total_test/total_test.json", "w");
        fwrite($fp, str_ireplace('"]},{"', '"],"', implode(",", $file_total)));
        fclose($fp);

        $strJsonFileContents = file_get_contents($file_quest_dir);
        $array = json_decode($strJsonFileContents, true); // Convert to array

        $fp = $fp = $this->fopen_file_totaltest($file_name_json, "w");
        fwrite($fp, json_encode($array, JSON_UNESCAPED_UNICODE));
        fclose($fp);
    }


    public function create_reletive_json_file($file_quest_dir){
        $dir    = 'views_test/json_question/';
        $files1 = scandir($dir);
        $file_total = [];

        for($i = 2; $i <= count($files1) - 1; $i++){
            $filename = "views_test/json_question/" . $files1[$i];
            $handle = fopen($filename, "r");
            $file_total_text = ($contents = fread($handle, filesize($filename)));
            array_push($file_total,$file_total_text);
            fclose($handle);
        }

        $file_name_json = mb_substr( $file_quest_dir, 39);
        if (file_exists("views_test/total_test/" . rtrim($file_name_json,".json"))) {
            $this->file_exists_empty($file_quest_dir,$file_total,$file_name_json);
        } elseif (!file_exists("views_test/total_test/" . rtrim($file_name_json,".json"))) {
            $this->file_exists_no_empty($file_quest_dir,$file_total,$file_name_json);
        }

        header('Location: ../tests-admin');
    }

    public function verefy_file_json($file,$name_tets,$question_arr,$answer_arr,$file_quest_dir){
        while (!feof($file)) {
            $str = fgets($file); // читаем файл построчно
            if (substr($str, 0, 10) === "{---------") { // находим начало вопроса
                $str_quest = strstr(fgets($file), ")"); // отрезаем номер вопроса до скобки ()
                $str_quest = trim(substr($str_quest, 1)); // отрезаем  скобку ( и пробелы в начале и конце
                $str_quest = rtrim($str_quest, "\r\n"); // отрезаем \r\n
                $question_arr[$str_quest] = [];  // создаем массив вопросов
                $answer_arr[$str_quest] = []; // создаем массив ответов
                fgets($file); // пропускаем строку &
                for ($i = 0; $i < 5; $i++) { // обходим 5 вариантов ответа
                    $str_answ = fgets($file); // считываем ответ
                    $str_answ = rtrim($str_answ, "\r\n"); // отрезаем  \r\n
                    $str_answ = trim($str_answ); // отрезаем  пробелы в начале и конце
                    if (substr($str_answ, 0, 1) === "*") { // если начинается на *
                        $question_arr[$str_quest][] = ltrim($str_answ, "*");  // вопрос записываем без *
                        $this->add_ans_question($name_tets,ltrim($str_answ, "*"));
                        $answer_arr[$str_quest][] = "true";  // ответ отмечаем как правильный
                    } else {   // иначе
                        $question_arr[$str_quest][] = $str_answ;  //  записываем вопрос
                        $answer_arr[$str_quest][] = "false"; // ответ отмечаем как неправильный
                    }
                }
                fgets($file); // пропускаем строку &
            }
        }
        $this->create_json_endoce_decode($question_arr,$answer_arr,$file_quest_dir);
    }

    public function create_json_endoce_decode($question_arr,$answer_arr,$file_quest_dir){
        $json_question = json_encode($question_arr, JSON_UNESCAPED_UNICODE);  // преобразуем массив вопросов в формат json
        $json_answer = json_encode($answer_arr, JSON_UNESCAPED_UNICODE); // преобразуем массив jndtnjd в формат json
        $jf_question = fopen($file_quest_dir, 'w'); // открываем файл json с вопросами на запись
        fwrite($jf_question, $json_question);
        fclose($jf_question);
        $file_ans_dir = 'views_test/json_ans/json_answer_' .  uniqid() . '.json';
        $jf_answer = fopen($file_ans_dir, 'w'); // открываем файл json с ответами на запись
        fwrite($jf_answer, $json_answer);
        fclose($jf_answer);
    }

    public function add_json_name($name_tets,$result_file_name,$text_test,$file_image_ret,$difficult) {
        return $this->query("INSERT INTO `out_test` (title,text,difficult,image,file_name) VALUES ('$name_tets','$text_test','$difficult','$file_image_ret','$result_file_name')");
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
        $this->create_json($file_txt_upload,$name_tets,$text_test,$file_image_ret,$difficult,$file_json['name']);
//        header('Location: /');
        return $file_txt_upload;
    }
}
