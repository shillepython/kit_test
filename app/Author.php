<?php
namespace app;
use mysql;
class Author extends UserObject {
    public function add_ans_question($name_tets,$answer)
    {
        return $this->query("INSERT INTO `ans_question` (name_test,ans) VALUES ('$name_tets','$answer')");
    }
    public function create_json($file_txt_upload,$name_tets,$text_test,$file_image_ret,$difficult,$file_json) {
        header('Content-Type: application/json; charset=utf-8');

        $this->create_total_file();

        $question_arr = [];
        $answer_arr = [];
        $file = fopen($file_txt_upload, "r"); // открываем файл на чтение

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
                        $this->add_ans_question($name_tets,ltrim($str_answ, "*")); //Добавление правильных ответов в бд.
                        $answer_arr[$str_quest][] = "true";  // ответ отмечаем как правильный
                    } else {   // иначе
                        $question_arr[$str_quest][] = $str_answ;  //  записываем вопрос
                        $answer_arr[$str_quest][] = "false"; // ответ отмечаем как неправильный
                    }
                }
                fgets($file); // пропускаем строку &
            }
        }
        $result_file_name = $this->encodeAnswer_Question($question_arr,$answer_arr); //Кодирование фалов
        $this->add_json_name($name_tets,$result_file_name,$text_test,$file_image_ret,$difficult); //Добавление в бд.
    }

    public function create_total_file(){
        $dir    = 'views_test/json_question/';
        $files1 = scandir($dir);
        $file_total = [];
        for($i = 2; $i <= count($files1) - 1; $i++){
            $filename = "views_test/json_question/".$files1[$i];
            $handle = fopen($filename, "r");
            $file_total_text = ($contents = fread($handle, filesize($filename)));
            array_push($file_total,$file_total_text);
            fclose($handle);
        }
        $fp = fopen("views_test/total_test/total_test.json", "w");
        fwrite($fp, implode(",", $file_total));
        fclose($fp);
    }

    public function encodeAnswer_Question($question_arr,$answer_arr){
        $json_question = json_encode($question_arr, JSON_UNESCAPED_UNICODE);  // преобразуем массив вопросов в формат json
        $json_answer = json_encode($answer_arr, JSON_UNESCAPED_UNICODE); // преобразуем массив jndtnjd в формат json
        $file_quest_dir = 'views_test/json_question/json_question_' .  uniqid() . '.json';
        $jf_question = fopen($file_quest_dir, 'w'); // открываем файл json с вопросами на запись
        fwrite($jf_question, $json_question);
        fclose($jf_question);
        $file_ans_dir = 'views_test/json_ans/json_answer_' .  uniqid() . '.json';
        $jf_answer = fopen($file_ans_dir, 'w'); // открываем файл json с ответами на запись
        fwrite($jf_answer, $json_answer);
        fclose($jf_answer);
        header('Location: ../tests-admin');
        return $result_file_name = mb_substr( $file_quest_dir, 25);
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
