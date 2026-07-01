<?php

class Validation{
    protected function validName($name){
        if ($name != "") {
            return true;
        } else {
            return false;
        }
    }
     protected function validPhone($phone){
        if ($phone != "" && strlen($phone) == 11) {
            return true;
        } else {
            return false;
        }
    } protected function validPassword($password){
        if ($password != "" && strlen($password) > 6) {
            return true;
        } else {
            return false;
        }
    }
}