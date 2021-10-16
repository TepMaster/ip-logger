<?php

$hostName = "localhost";
$userName = "user";
$password = "QAZ123qaz";
$databaseName = "test";
$tableImg = "image_data";
$table = "main2";
$portNo = "3306";

$mysqli = new mysqli($hostName, $userName, $password, $databaseName, $portNo);

$conn = new mysqli($hostName, $userName, $password, $databaseName);