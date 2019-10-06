<?php
namespace app;

abstract class AbstractModel extends Connection {
    abstract public function getElementsTable($row_table,$id);
    abstract public function searchUser($name);
    abstract public function searchUserGroup($group);
}