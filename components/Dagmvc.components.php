<?php


class Dagmvc {
    public static function loginForm() {
        $lg = new Language();
        echo "<div class='has-bg-light' style='height: 100%; padding: 0px 40px'>
                <div class='columns'>
                    <div class='column is-two-fifths has-text-light has-background-primary level-item has-text-centered' style='height: 90vh; margin: 5vh 0; border-radius: 10px 0 0 10px; box-shadow: -4px 4px 4px #3c3c3c;;'>
                        <div style='margin: 30% auto;'>
                            <h1 style='padding: 10px; font-size: 45px; font-weight: 700;'>" . $lg->translate('welcome') . "</h1>
                            <p style='padding: 10px 20px 30px 30px;;'>" . $lg->translate('welcomeMSG') . "</p>";
                            Bulma::button('a', '/register', $lg->translate('RegNow'), ['is-link', 'is-medium']);
        echo "</div></div>
               <div class='column is-three-fifths has-text-black level-item has-text-centered' style='height: 90vh; margin: 5vh 0; border-radius: 0 10px 10px 0; box-shadow: 4px 4px 4px #3c3c3c;'>
                    <div style='margin: 20% auto;'>
                    <h1 style='padding: 10px; font-size: 45px; font-weight: 700;'>" . $lg->translate('Login') . " </h1>
                    <form method='post' action='/login/submit' class='column is-three-fifths is-offset-one-fifth'>";
                    Form::input('text', 'username', ['is-large', 'is-primary'], '', $lg->translate('username'), '', 'fas fa-envelope');
                    Form::input('password', 'password', ['is-large', 'is-primary'], '', $lg->translate('password'), '', 'fas fa-lock');
                    Form::button('login', $lg->translate('Login'), ['button', 'is-primary', 'is-fullwidth', 'is-large']);
        echo "</form></div></div>";
        echo "</div>";
        echo "</div>";
    }
}