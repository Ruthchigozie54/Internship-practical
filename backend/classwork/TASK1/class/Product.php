<?php

include("Database.php");
include("../trait/Notification.php");

class Product extends Database{

  use Notification;

  public function add(string $x){
    echo "added $x using product ";
    $this->send();
  }

}

$p = new Product();
$p->add("shoe ");
