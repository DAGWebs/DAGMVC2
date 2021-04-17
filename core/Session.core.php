<?php


class Session {
    public static function exists($name) {
        if(isset($_SESSION[$name])) {
            return true;
        } return false;
    }

    public static function set($name, $value) {
        return $_SESSION[$name] = $value;
    }

    public static function get($name, $echo = false) {
       if(self::exists($name) && $echo) {
           echo $_SESSION[$name];
       } else {
           return $_SESSION[$name];
       }
    }

    public static function delete($name) {
        if(self::get($name)) {
            unset($_SESSION[$name]);
        }
    }
}