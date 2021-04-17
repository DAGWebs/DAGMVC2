<?php


class Router {
    public static function setRoute() {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);

        if(!empty($url)) {
            foreach($url as $urlPart) {
                if($url[0] === '') {
                    array_shift($url);
                }
            }
        }

        ((!empty($url) && $url[0] !== '') ? $controller = $url[0] : $controller = DEFAULT_CONTROLLER);

        array_shift($url);

        ((!empty($url) && $url[0] !== '') ? $action = $url[0] . "Action" : $action = 'indexAction');

        array_shift($url);

        if(!empty($url) && $url[0] !== '') {
            if(file_exists('app' . DS . 'controllers' . DS . $controller . DS . $controller . '.controller.php')) {
                if(class_exists($controller) && method_exists(new $controller, $action)) {
                    call_user_func_array([new $controller, $action], $url);
                } else {
                    echo "We are sorry but the page you are looking for does not exist!";
                }
            } else {
                echo "We are sorry but the page you are looking for does not exist!";
            }
        } else {
            if(file_exists('app' . DS . 'controllers' . DS . $controller . DS . $controller . '.controller.php')) {
                if(class_exists($controller) && method_exists(new $controller, $action)) {
                    $call = new $controller();
                    $call->$action();
                } else {
                    echo "We are sorry but the page you are looking for does not exist!";
                }
            } else {
                echo "We are sorry but the page you are looking for does not exist!";
            }
        }

    }
}