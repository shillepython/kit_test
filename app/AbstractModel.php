<?php
namespace app;
abstract class AbstractModel {
    abstract public function getElementsTable($row_table,$id);
}