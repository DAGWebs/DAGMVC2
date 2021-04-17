<?php


class Login {
    private $view;

    public function __construct() {
        $this->view = new View('auth');
    }

    public function indexAction() {
        View::setTitle('Login');
        $this->view->render('auth', 'login');
    }
}