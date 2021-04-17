<?php


class View {
    private $layout;
    private static $title;

    public function __construct($layout) {
        $this->layout = $layout;
    }
    public function render($viewName, $view) {
        $header = 'app' . DS . 'views' . DS . 'layouts' . DS . $this->layout . '-header.layout.php';
        $footer = 'app' . DS . 'views' . DS . 'layouts' . DS . $this->layout . '-footer.layout.php';
        $view   = 'app' . DS . 'views' . DS . $viewName . DS . $view . '.view.php';

        if(file_exists($header) && file_exists($footer) && file_exists($view)) {
            include($header);
            include($view);
            include($footer);
        } else {
            Errors::set(
                'Cant Find View: ' . $view,
                'The view could not be found',
                'please check the view located in <br /> ' . $view
            );
        }
    }

    public static function setTitle($title) {
        self::$title = $title;
    }

    public static function getTitle() {
        return self::$title;
    }
}