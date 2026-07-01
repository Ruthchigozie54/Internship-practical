<?php 
include("Database.php");
include("../trait/Notification.php");
include("../trait/Validation.php");

class User extends Database{

  use Notification, Validation;

  public function create(){

    $this->send();
    $this->empty();

  }

}
$girl = new User();
$girl->create();








?>