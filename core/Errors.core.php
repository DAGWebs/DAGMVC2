<?php


class Errors {
    public static function set($title, $description, $fixes) {
        $error = ' 
                    <link rel="stylesheet" href="/assets/css/system.css">
                    <div class="system-error">
                        <h1>' . $title . '</h1>
                        <p>' . $description . '</p>
                        <p>' . $fixes . '</p>
                   </div>';

        echo $error;
        die();
    }
}