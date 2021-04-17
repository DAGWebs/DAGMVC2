<?php


class Language {
    private $language;

    private function getLanguageFiles() {
        return scandir('lang');
    }

    public function setLanguage($lang) {
        $this->language = $lang . '.php';
    }

    public function getFiles() {
        if(in_array($this->language, $this->getLanguageFiles())) {
            require_once 'lang' . DS . $this->language;
        } else {
            require_once 'lang' . DS . 'en.php';
        }
    }

    public function translate($cond) {
        return LANG[$cond];
    }
}