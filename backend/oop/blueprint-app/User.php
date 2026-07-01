<?php
include 'Validate.php';

class User extends Validate{

  public function save($name, $phoneNumber, 
  $password) {
  if ($this->validateName($name) 
    && $this->validatePhoneNumber($phoneNumber) 
    && $this->validatePassword($password)) 
    {
    echo "Valid data, User saved successfully!";
  } else {
    echo "Invalid data, unable to save user.";
  }
}
}

$name = readline("Enter your name: ");
$phoneNumber = readline("Enter your phone number: "); 
$password = readline("Enter your password: ");
$user = new User();
$user->save($name, $phoneNumber, $password);