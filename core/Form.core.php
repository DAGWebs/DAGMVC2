<?php


class Form {
    private static function getDiv() {
        switch(STYLE_WORKS) {
            case 'bulma':
                $div = "<div class='control has-icons-left has-icons-right'>";
                break;
            case 'bootstrap':
                $div = "<div class='form-group'>";
                break;
            case 'materialize':
                $div = "<div class='input-field'>";
                break;
            default:
                $div = '<div class="form-seperator">';
                break;
        }
        return $div;
    }

    private static function getClasses() {
        switch(STYLE_WORKS) {
            case 'bulma':
                $div = "input";
                break;
            case 'bootstrap':
                $div = "form-control";
                break;
            case 'materialize':
                $div = "validate";
                break;
            default:
                $div = 'default-input';
                break;
        }
        return $div;
    }

    public static function input($type, $name, $classes, $value, $placeholder, $label = false, $fa = false) {
        $div = self::getDiv();
        $input = "<input type='{$type}' id={$name} name='{$name}' ";
        $getClass = self::getClasses();
        if(!empty($classes)) {
            if(!is_array($classes)) {
                $input .= "class='{$classes} {$getClass}' ";
            } else {
                $classString = '';
                foreach($classes as $class) {
                    $classString .= "{$class} ";
                }
                $classString = rtrim($classString, ' ');
                $input .= "class='{$getClass} {$classString} ' ";
            }
        }

        if($fa) {
            $fai = "<span class='icon is-left'>
                      <i class='{$fa}'></i>
                    </span>";
        } else {
            $fai = '';
        }

        if(!empty($value)) {
            $input .= "value='{$value}' ";
        }

        if(!empty($placeholder)) {
            $input .= "placeholder='{$placeholder}' ";
        }

        if($label) {
            $label = "<lable class='label' for='{$name}'>{$placeholder}: </lable>";
        } else {
            $label = '';
        }
            $input = rtrim($input, ' ');
            $input .= ">";
            echo "<div class='field'>" . $div . $label . $input . $fai . "</div></div>";
    }

    public function select($name, $id, $options, $classes=[], $label = false, $placeholder) {
        $div = self::getDiv();
        $getClass = self::getClasses();
        if($label) {
            $label = "<label class='label' for='{$id}'>{$placeholder}</label>";
        } else {
            $label = "";
        }
        $select = "<div class='field'>
                    {$label}
                    {$div}
                        <div class='select'>
                            <select name='{$name}' id='{$id}'";
        if(!empty($classes)) {
            if(!is_array($classes)) {
                $select .= " class='select {$classes} {$getClass}' ";
            } else {
                $classString = '';
                foreach($classes as $class) {
                    $classString .= "select {$class} ";
                }
                $classString = rtrim($classString, ' ');
                $select .= " class='select {$getClass} {$classString} ' ";
            }
        } else {
            $select .= " class='' ";
        }
        $select .= ">";
        if(!is_array($options)) {
            Errors::set('Form Select Creation Error',
                            'Options must be in the form of an array',
                        'To fix this you need to make sure that the options are in an array <br /> [option => value]'

            );
        } else {
            foreach($options as $option => $value) {
                if(is_array($value)) {
                    $valString = '';
                    foreach($value as $val) {
                        $valString .= $val . " ";
                    }
                    $valString = rtrim($valString, " ");
                    $select .= "<option {$valString} value='{$value[0]}'>{$option}</option>";
                } else {
                    $select .= "<option value='{$value}'>{$option}</option>";
                }
            }

            echo $select . "</div></div></div>";
        }
    }

    public static function textarea($name, $id, $classes, $value, $placeholder, $label = true) {
        $div = self::getDiv();
        $textarea = "<textarea name='{$name}' id='{$id}' ";
        $getClass = self::getClasses();

        if(!empty($classes)) {
            if(!is_array($classes)) {
                $textarea .= "class='textarea {$classes} {$getClass}' ";
            } else {
                $classString = '';
                foreach($classes as $class) {
                    $classString .= "{$class} ";
                }
                $classString = rtrim($classString, ' ');
                $textarea .= "class='textarea {$getClass} {$classString} ' ";
            }
        }

        if(!empty($value)) {
            $textarea .= "value='{$value}' ";
        }

        if(!empty($placeholder)) {
            $textarea .= "placeholder='{$placeholder}' ";
        }

        if($label) {
            $label = "<lable class='label' for='{$name}'>{$placeholder}: </lable>";
        } else {
            $label = '';
        }

        $textarea = rtrim($textarea, ' ');
        $textarea .= "></textarea>";
        echo "<div class='field'>" . $label . $div . $textarea . "</div></div>";
    }

    public static function checkBox($checkboxText) {
        echo '<div class="field">
          <div class="control">
            <label class="checkbox">
              <input type="checkbox">
                    ' . $checkboxText . '
            </label>
          </div>
        </div>';
    }

    public static function radio($options) {
        if(is_array($options)) {
            $input = '';
            foreach($options as $option => $settings) {
                $input .= "<label class='radio'><input type='radio' name='{$settings['name']}' value='{$settings['value']}'>{$settings['value']}</label>";
            }
        } else {
            Errors::set('Form Radio Selection Error',
                'Options must be in the form of an array',
                'To fix this you need to make sure that the options are in an array <br /> [option => value]'

            );
        }

        $radio = '<div class="field">
                      <div class="control">
                         ' . $input . '
                      </div>
                    </div>';

        echo $radio;
    }

    public static function button($name, $value, $classes, $icon = false) {
        if(!is_array($classes)) {
            Errors::set('Form Button Creation Error',
                'Classes must be in the form of an array',
                'To fix this you need to make sure that the classas are in an array <br /> [button, btn, btn-primary]'

            );
        } else {
            $classString = '';
            foreach($classes as $class) {
                $classString .= $class . ' ';
            }

            $classString = rtrim($classString, ' ');
        }
        echo '<div class="control">
                  <button type="submit" name="' . $name . '" class="' . $classString . '">' . $value . '</button>
               </div>';
    }
}


