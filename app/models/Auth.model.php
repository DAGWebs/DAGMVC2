<?php


class Auth extends Model {
    public $table = 'users';

    public function __construct() {
        parent::__construct($this->table);
    }

    public function isLoggedin() {
        if(Session::exists('isLoggedin') || Cookie::exists('isLoggedin')) {
            return true;
        } else {
            return fasle;
        }
    }

    public function emailExists($email) {
        return $this->select(['user_email' => $email]);
    }

    public function usernameExists($username) {
        return $this->select(['user_username' => $username]);
    }

    public function accountActive($id) {
        $query = $this->select(['user_id' => $id]);
        $row = DB::getInstance()->fetch($query);

        $active = $row['user_isActive'];

        if($active == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function validateLogin($username, $password) {
        if($this->emailExists($username) || $this->usernameExists($username)) {
            if(DB::getInstance()->query_worked($this->emailExists($username))) {
                $row = DB::getInstance()->fetch(DB::getInstance()->query_worked($this->emailExists($username)));
                $db_password = $row['user_password'];
            } else if(DB::getInstance()->query_worked($this->usernameExists($username))) {
                $row = DB::getInstance()->fetch(DB::getInstance()->query_worked($this->usernameExists($username)));
                $db_password = $row['user_password'];
            }
            if(Security::hash_check($password, $db_password)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}