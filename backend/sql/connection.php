<?php


$connection = new mysqli("localhost", "root","", "bubble_data");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
