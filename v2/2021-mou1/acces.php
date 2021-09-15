<?php
session_start();
$acces = $_SESSION['acces'];
$log = $_SESSION['log'];

//BD-conn

$servername = "localhost";
$username = "user";
$password = "QAZ123qaz";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


echo $acces.'<p>';
echo $log;
?>