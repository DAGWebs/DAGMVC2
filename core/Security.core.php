<?php


class Security {
    public static function escape($html) {
        $html = trim($html);
        $html = strip_tags($html);
        $html = stripslashes($html);
        $html = htmlentities($html, ENT_QUOTES);
        $html = DB::getInstance()->escape($html);

        return $html;
    }

    public static function space($text) {
        return str_replace(' ', '', $text);
    }

    public static function validateEmail($email) {
        return filter_var($email,FILTER_VALIDATE_EMAIL);
    }

    public static function generateToken() {
        return md5(uniqid() . rand(000000, 99999999));
    }

    public static function checkToken($token) {
        if(Session::exists('form-token')) {
            if(Session::get('form-token') === $token) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function hash($text, $encryption = PASSWORD_BCRYPT) {
        return password_hash($text, $encryption);
    }

    public static function hash_check($text, $hash) {
        if(password_verify($text, $hash)) {
            return true;
        } else {
            return false;
        }
    }
}