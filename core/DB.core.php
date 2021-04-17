<?php


class DB {
    protected $con;
    protected static $instance = NULL;

    protected function __construct() {
        $this->con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public static function getInstance() {
        if(isset(self::$instance) && self::$instance !== NULL) {
            return self::instance;
        } else {
            self::$instance = new DB();
            return self::$instance;
        }
    }

    public function query($sql) {
        return mysqli_query($this->con, $sql);
    }

    public function insert($table, $fields, $autoEscape = true) {
        if(is_array($fields)) {
            $fieldString = '';
            $valueString = '';
            foreach($fields as $field => $val) {
                if($autoEscape) {
                    $val = Security::escape($val);
                }
                $valueString .= "'{$val}', ";
                $fieldString .= "`{$field}`, ";
            }
            $fieldString = rtrim($fieldString, ', ');
            $valueString = rtrim($valueString, ', ');

            $sql = "INSERT INTO `{$table}` ({$fieldString}) VALUES ({$valueString})";

            return $this->query($sql);
        } else {
            Errors::set('Database Insert Error',
                'You must use an array when inserting into the database',
                'The second argument should be an asoc array: <br /> DB::getInstance()->insert(table, [key => value])');
        }
    }

    public function select($table, $fields, $selector = '*', $cond = "", $autoEscape = true) {
        if(!is_array($fields)) {
            Errors::set('Database Selection Error',
                'You must use an array when Selecting DATA from the database',
                'The second argument should be an asoc array: <br /> DB::getInstance()->select(table, $field = [key => value])');
        } else {
            if(is_array($selector)) {
                $selectString = "";
                foreach($selector as $option) {
                    $selectString .= '`' . $option . '`, ';
                }
                $selectString = rtrim($selectString, ', ');
            } else {
                $selectString = $selector;
            }

            $fieldString = "";
            foreach($fields as $field => $value) {
                if($autoEscape) {
                    $value = Security::escape($value);
                }
                $fieldString .= "`$field` = '{$value}' {$cond} ";
            }
            $fieldString = rtrim($fieldString, " " . $cond . " ");
            $sql = "SELECT {$selectString} FROM `{$table}` WHERE {$fieldString}";

            return $this->query($sql);
        }
    }

    public function update($table, $set, $cond, $autoEscape = true) {
        if(!is_array($set) || !is_array($cond)) {
            Errors::set('Database Update Error',
                'You must use an array when updating Data in the database',
                'The second and third argument should be an array: <br /> DB::getInstance()->update(table, set= [item => value, item2 => value], cond = [id, value])');
        } else {
            $updateString = "";
            $conditionField = "";
            foreach($set as $update => $value) {
                if($autoEscape) {
                    $value = Security::escape($value);
                }
                $updateString .= "`{$update}` = '{$value}', ";
            }

            foreach($cond as $condition => $val) {
                if($autoEscape) {
                    $val = Security::escape($val);
                }
                $conditionField .= "`{$condition}` = '{$val}'";
            }
            $updateString = rtrim($updateString, ', ');
            $sql = "UPDATE `{$table}` SET {$updateString} WHERE {$conditionField}";
            die($sql);
            return $this->query($sql);
        }
    }

    public function delete($table, $cond) {
        if(!is_array($cond)) {
            Errors::set('Database Delete Error',
                'You must use an array when Deleting DATA from the database',
                'The second argument should be an asoc array: <br /> DB::getInstance()->delete(table, condition = [key => value])');
        } else {
            $condString = "";
            foreach($cond as $condition => $val) {
                $condString .= "`{$condition}` = '{$val}'";
            }
            $sql = "DELETE From `{$table}` WHERE {$condString}";
            return $this->query($sql);
        }
    }

    public function softDelete($table, $id) {
        if(!is_numeric($id)) {
            Errors::set('Database Soft Delete Error',
                'ID must be a numeric value',
                'The second argument should be a numeric value: <br /> DB::getInstance()->softDelete(table,id)');
        } else {
            return $this->update($table, ['is_softDeleted' => 1], [rtrim($table, 's') . '_id' => $id]);
        }
    }

    public function rows($query) {
        return mysqli_num_rows($query);
    }

    public function query_worked($query) {
        if($this->rows($query) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function fetch($query) {
        if($this->query_worked($query)) {
            return mysqli_fetch_assoc($query);
        } else {
            return false;
        }
    }

    public function createTable($table, $tableName) {
        if(!is_array($table)) {
            Errors::set('Database Table Creation Error',
                'You must use an array when creating a database table',
                'The argument should be an asoc array: <br /> DB::getInstance()->createTable([columnName => [characteristics]], Table Names)');
        } else {
            $tableInfo = '';
            $settingInfo = "";
            foreach($table as $column => $settings) {
                foreach($settings as $setting) {
                    $settingInfo .= $setting . " ";
                }
                $settingInfo = trim($settingInfo);
                $tableInfo .= $column . " {$settingInfo}, ";
                $settingInfo = "";
            }
            $tableInfo = rtrim($tableInfo, ', ');
            $sql = "CREATE TABLE {$tableName} ({$tableInfo});";
            return $this->query($sql);
        }
    }

    public function escape($text) {
        return mysqli_real_escape_string($this->con, $text);
    }
}