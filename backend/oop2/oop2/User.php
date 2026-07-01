<?php
include "validation.php";

class User extends Validation{

public function save($name, $phone, $password){
    if ($this->validName($name)
        && $this->validPhone($phone)
        && $this->validPassword($password)){
            return "Valid data, saved successfully";
        }
        else {
            return "Invalid data, unable to save";
        }
    }
}
