<?php

$con = mysqli_connect('localhost', 'root', '', 'world');

if (!$con) {
    die("Unable to connect to the database");
}
