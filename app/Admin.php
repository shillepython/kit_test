<?php
namespace app;
use mysql;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Admin extends UserObject {
    private $table = '`users`';

    //Получить всю таблиц
    public function AllTable(){
        return $this->query("SELECT * FROM " . $this->table);
    }

    //Получить таблицу роль
    public function roleTable(){
        return $this->query("SELECT * FROM `roles`");
    }

    //Получить айди пользователя из бл по id
    public function getId($id) {
        return $this->query("SELECT * FROM `users` WHERE id='$id'");
    }

    //Удаление пользователя
    public function deleteUser($id)
    {
        return $this->query("DELETE FROM " . $this->table . " WHERE id = '$id'");
    }

    //Обновление данных пользователя
    public function updateUser($id,$login,$password,$name,$surname,$birth_date,$email,$token,$verefy,$phone,$today,$group_id,$role_id)
    {
        return $this->query("UPDATE `users` SET login='$login', password='$password', name='$name', surname='$surname', birth_date='$birth_date', email='$email', token='$token', verefy='$verefy', tel='$phone', registration_date='$today', group_id='$group_id', role_id='$role_id' WHERE id='$id'");
    }


    public function out_test() {
        return $this->query("SELECT * FROM `out_test`");
    }






    public function return_row($row_table,$getTest) {
        $row_ass = $getTest->fetch_assoc();
        return $row_ass[$row_table];
    }

    public function getTestTable($row_table,$id) {
        $get_select = $this->query("SELECT `$row_table` FROM `out_test` WHERE id='$id'");
        return $this->return_row($row_table,$get_select);
    }

    public function getPasswordUser($row_table,$login) {
        $get_select = $this->query("SELECT `$row_table` FROM `users` WHERE login='$login'");
        return $this->return_row($row_table,$get_select);
    }

    public function getEmailUser($row_table,$email) {
        $get_select = $this->query("SELECT `$row_table` FROM `users` WHERE email='$email'");
        return $this->return_row($row_table,$get_select);
    }

    public function sendEmail($subject,$body,$email){
        if($this->getEmailUser('email', $email)){
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'appletrollface@gmail.com';                     // SMTP username
                $mail->Password   = 'svyatoi2003';                               // SMTP password
                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = 587;
                $mail->CharSet = 'UTF-8';
                // TCP port to connect to

                //Recipients
                $mail->setFrom('appletrollface@gmail.com', 'Kit-Test');
                $mail->addAddress($email, 'Kit-Test.ua');     // Add a recipient


                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $body;

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }else{
            echo 'Почта не существует!';
        }
    }

    public function download_user_file(){
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=user_database.csv');
        $output = fopen("php://output", 'w') or die("не удалось создать файл");
        fputcsv($output, array('ID', 'Login', 'Password', 'Name', 'Surname', 'date', 'email', 'Phone', 'Registration', 'Group', 'Role'), ",");
        $users = [];
        $sql = $this->query("SELECT * FROM `users` ORDER BY id DESC");
        while ($row = $sql->fetch_row()){
            if ($row[12] == "1"){
                $status = "User";
            }elseif ($row[12] == "2"){
                $status = "Author";
            }elseif ($row[12] == "3"){
                $status = "Admin";
            }
            $users[] = array($row[0],$row[1],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$status);
        }

        fputs($output, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) )); // Для поддержки кириллицы добавляются отметки BOM, альтернативные решения - https://csv.thephpleague.com/9.0/converter/charset/, https://stackoverflow.com/questions/17592707/php-export-csv-when-data-having-utf8-charcters, https://phpspreadsheet.readthedocs.io/en/latest/
        foreach ($users as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
    }

    public function editTests ($id){
        //
    }
}
