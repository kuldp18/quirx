<?php

$host = "localhost";
$db = "quirx_1";
$username = "root";
$password = "";

try{
    $pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception
}catch(PDOException $e){
    die("Error connecting to database: " . $e->getMessage() . "<br/>");
}