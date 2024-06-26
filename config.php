<?php 
session_start();
$username = "root";
$password = "";
$conn = new PDO("mysql:host=localhost;dbname=ticaret_proje", $username, $password);

?>