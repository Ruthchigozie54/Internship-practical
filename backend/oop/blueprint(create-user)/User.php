<?php
require_once 'Validation.php';

class User extends Validation {

  public function save($name, $phoneNumber, $password, $dob) {
      // Added validateAge to the condition check
      if ($this->validateName($name) 
        && $this->validatePhoneNumber($phoneNumber) 
        && $this->validatePassword($password)
        && $this->validateAge($dob)) 
      {
          // Return an array with a success status
          return [
              'status' => 'success',
              'message' => "<div class='alert alert-success'>Valid data, User saved successfully!</div>"
          ];
      } else {
          // Return an array with an error status
          return [
              'status' => 'error',
              'message' => "<div class='alert alert-error'>Invalid data. Please check your inputs and ensure you are at least 18 years old.</div>"
          ];
      }
  }
}
?>