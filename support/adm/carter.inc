<?php
$host="localhost";
$database="nomasint_punkysite";
$user="nomasint_s0r3n";
$password="Edzp0DyR7H";

$conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>