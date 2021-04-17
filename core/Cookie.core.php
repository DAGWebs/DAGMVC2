<?php


class Cookie {
    public static function set($name, $value, $time = 1) {
        return setcookie($name, $value, time() + ($time * 86400));
    }

    public static function exists($name) {
        if(isset($_COOKIE[$name])) {
            return true;
        } else {
            return false;
        }
    }

    public static function get($name, $echo = false) {
        if(slef::exists($name) && $echo !== false) {
            echo $_COOKIE[$name];
        } else if(self::exists($name) && $echo === false) {
            return $_COOKIE[$name];
        }
    }

    public static function delete($name) {
        return setcookie($name, '', time() - 1);
    }
}