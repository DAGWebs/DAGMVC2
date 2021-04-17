<?php


class Bulma {
    public static function container($text, $classes = []) {
        $div = "<div class='container'>";
        if(!is_array($classes) && !empty($classes)) {
            $div .= "<div class='{$classes}'>{$text}</div>";
        } else {
            $classNames = '';
            if(is_array($classes)) {
                foreach($classes as $class) {
                    $classNames .= $class . " ";
                }
                $classNames = rtrim($classNames, ' ');
                $div .= "<div class='{$classNames}'>{$text}</div>";
            } else {
                $div .= "<div class='bulma-container'>{$text}</div>";
            }
        }
        echo $div . "</div>";
    }

    public static function hero($title, $subtitle, $color) {
        $hero = "<section class='hero is-{$color}'>
                    <div class='hero-body'>
                        <p class='title'>{$title}</p>
                        <p class='subtitle'>{$subtitle}</p>
                    </div>
                </section>";

        echo $hero;
    }

    public static function section($title, $subtitle, $size = "") {
        $section = "<section class='section {$size}'>
                      <h1 class='title'>{$title}</h1>
                      <h2 class='subtitle'>
                       {$subtitle}
                      </h2>
                    </section>";

        echo $section;
    }

    public static function footer($content) {
        echo '<footer class="footer">
                  <div class="content has-text-centered">
                    <p>
                     ' . $content . '
                    </p>
                  </div>
                </footer>';
    }

    public static function breadCrumb($links) {
        $link = '<nav class="breadcrumb is-centered" aria-label="breadcrumbs">
                      <ul>';

        $breadCrumb = '';

        foreach($links as $link => $val) {
            $breadCrumb .= "<li><a href='$val'>{$link}</a></li>";
        }

        $link .= $breadCrumb . '
                      </ul>
                    </nav>';
        echo $link;
    }

    public static function card($content) {
        echo '<div class="card">
                  <div class="card-content">
                    <div class="content">
                      ' . $content . '
                    </div>
                  </div>
                </div>';
    }

    public static function cardFooter($title, $subtitle, $footer1, $footer2) {
        echo '<div class="card">
                  <div class="card-content">
                    <p class="title">
                      ' . $title . '
                    </p>
                    <p class="subtitle">
                      ' . $subtitle . '
                    </p>
                  </div>
                  <footer class="card-footer">
                    <p class="card-footer-item">
                      <span>
                        ' . $footer1 . '
                      </span>
                    </p>
                    <p class="card-footer-item">
                      <span>
                        ' . $footer2 . '
                      </span>
                    </p>
                  </footer>
                </div>';
    }

    public static function cardImg($img, $title, $subtitle, $content) {
        echo '<div class="card">
                  <div class="card-image">
                    <figure class="image is-4by3">
                      <img src="' . $img . '">
                    </figure>
                  </div>
                  <div class="card-content">
                    <div class="media">
                      <div class="media-left">
                        <figure class="image is-48x48">
                          <img src="' . $img . '" alt="Placeholder image">
                        </figure>
                      </div>
                      <div class="media-content">
                        <p class="title is-4">' . $title . '</p>
                        <p class="subtitle is-6">' . $subtitle . '</p>
                      </div>
                    </div>
                
                    <div class="content">
                      ' . $content . '
                    </div>
                  </div>
                </div>';
    }

    public static function dropDown($name, $content) {
        $lk = '';
        foreach($content as $link => $val) {
            $lk .= '<a href="' . $link . '" class="dropdown-item">' . $val . '</a>';
        }
        echo '<div class="dropdown">
                  <div class="dropdown-trigger">
                    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu3">
                      <span>' . $name . '</span>
                      <span class="icon is-small">
                        <i class="fas fa-angle-down" aria-hidden="true"></i>
                      </span>
                    </button>
                  </div>
                  <div class="dropdown-menu" id="dropdown-menu3" role="menu">
                    <div class="dropdown-content">
                      ' . $lk . '
                    </div>
                  </div>
                </div>';
    }

    public static function sideNav($links, $bg='white', $tx_color='dark', $active='', $activetxt = '') {
        $menu = "<aside class='menu nav is-black has-background-{$bg} ' style='height: 100vh; padding: 10px;'>";

        $menuLinks = "";

        foreach($links as $link => $val) {

            $menuLinks .= "
                            <p class='menu-label has-text-{$tx_color}'>{$link}</p>
                            <ul class='menu-list'>";
            $classNames = '';
            foreach($val as $key => $value) {
                if(is_array($value)) {

                    if($key === 'classes') {
                        foreach ($value as $class) {
                            $classNames .= $class . " ";
                        }
                        $classNames = rtrim($classNames);
                    }

                    if(array_key_exists('icon', $value)) {

                        $icon = '<span class="menu-icon">
                                    <i class="' . $value['icon'] . '"></i>
                                  </span>';
                        $menuLinks .= "<li><a class='has-text-{$tx_color} {$classNames}' href='{$value['link']}'>{$icon} {$value['name']}</a></li>";
                    }

                    if($key === 'submenu') {

                        foreach($value as $key => $val) {

                            $menuLinks .= "<li>";
                            if($key == 'primary') {
                               $menuLinks .= "<a class='has-background-{$active} has-text-{$activetxt} is-active'>{$val}</a>";
                                $menuLinks .= '<ul>';
                            } else {
                               $menuLinks .= "<li><a class='has-text-{$tx_color} {$classNames}' href='{$key}'>{$val}</a></li>";
                            }
                        }
                        $menuLinks .= '</ul>';
                    }
                } else {
                    $menuLinks .= "<li><a class='has-text-{$tx_color} {$classNames}' href='{$key}'>{$value}</a></li>";
                }
            }
            $menuLinks .= "</ul>";

        }

        $menu .= "{$menuLinks}</aside>";
        echo $menu;
    }

    public static function button($type, $linkTo, $name, $classes) {
        $classString = '';
        if(!is_array($classes)) {
            Errors::set('Bulma Button Creation Error',
                            'Button classes must be an array',
                            'Please use the $classes variable as an array <br /> [is-large, id-primary]'
            );
        }
        if($type === 'a' || 'anchor' || 'link') {
            foreach($classes as $class) {
                $classString .= $class . " ";
            }
            $classString = rtrim($classString, ' ');
            echo '<a class="button ' . $classString . '" href="' . $linkTo . '">' . $name . '</a>';
        } else if($type === 'b' || 'button') {

        }
    }
}