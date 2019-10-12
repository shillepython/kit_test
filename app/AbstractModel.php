<?php
namespace app;
abstract class AbstractModel {
    use Connection;
    abstract public function getElementsTable($row_table,$id);
    abstract public function searchUser($name);
    abstract public function searchUserGroup($group);
}