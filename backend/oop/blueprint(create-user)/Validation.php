<?php 


class Validation
{
    protected function validatePhoneNumber($phoneNumber) {
      
        if ($phoneNumber != "" && strlen($phoneNumber) == 11) {
            return true;
        } else {
            return false;
        }
    }

    protected function validatePassword($password) {
        if ($password != "" && strlen($password) >= 6) {
            return true;
        } else {
            return false;
        }
    }

    protected function validateName($name) {
        if ($name != "" && strlen($name) >= 3) {
            return true;
        } else {
            return false;
        }
    }

    // New Method: Validate if the user is 18 or older
    protected function validateAge($dob) {
        if ($dob == "") {
            return false;
        }
        
        $dobDate = new DateTime($dob);
        $today = new DateTime();
        
        // Calculate the difference in years between today and the Date of Birth
        $age = $today->diff($dobDate)->y;
        
        if ($age >= 18) {
            return true;
        } else {
            return false;
        }
    }
}
?>