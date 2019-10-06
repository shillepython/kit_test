<?php
namespace app;

abstract class AbstractModel extends Connection {
    abstract public function AllTable();
    abstract public function roleTable();
    abstract public function getId($id);
    abstract public function add_user_sql($login,$password,$name,$surname,$birth_date,$email,$phone,$today,$role_id);
    abstract public function query_log_pass($login,$password);
    abstract public function query_log($login);
    abstract public function select_num_rows($login,$password);
    abstract public function deleteUser($id);
    abstract public function getElementsTable($row_table,$id);
    abstract public function searchUser($name);
    abstract public function searchUserGroup($group);
    abstract public function uploadFile($name_tets,$file_json);
}