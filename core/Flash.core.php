<?php


class Flash {
    public static function set($value, $classes) {
        Session::set('flash', [$value => $classes]);
    }

    public static function show() {
        if(Session::exists('flash')) {
            echo "Flash Exists";
            $className = Session::get('flash');
            $classNames = '';
            foreach($className as $key => $val) {
                foreach($val as $class) {
                    $classNames .= $class . " ";
                }

                $classNames = rtrim($classNames, " ");
                $div = "<div class='{$classNames}'> 
                            <p>{$key}</p>
                        </div>";

                echo $div;

                Session::delete('flash');
            }
        }
    }
}