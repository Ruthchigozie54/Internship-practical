<?php


class Validate
{
    protected function validatePhoneNumber($phoneNumber)
    {
        if ($phoneNumber != "" && strlen($phoneNumber) == 11) {
            return true;
        } else {
            return false;
        }
    }

    protected function validatePassword($password)
    {
        if ($password != "" && strlen($password) >= 6) {
            return true;
        } else {
            return false;
        }
    }

   protected function validateName($name)
    {
    if ($name != "" && strlen($name) >= 3) {
        return true;
    } else {
        return false;
    }
}
}

