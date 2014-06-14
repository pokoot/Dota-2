<?php

class SelectBox {

    static function create( $name, $value = '' , $options , $submit = true) {
        $opt = '<option value="0">Please Select</option>';
        foreach( $options AS $o ){
            $sel = ($value == $o['id']) ? 'selected' : '';
            $opt .= "<option value=" . $o['id'] . " $sel >" . $o['name'] . "</option>";
        }

        if ($submit ){
            $submit = "onchange='submit();'";
        }else {
            $submit = '';
        }

        return "<select name='$name' $submit >" . $opt . "</select>";
    }
}
