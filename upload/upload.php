<?php
#DB SETUP

$data = json_decode(file_get_contents('../config.txt', true),true);
$servername = $data['server'];
$username = $data['user'];
$password = $data['pass'];
$dbname = $data['db'];
$dom = $data['domain'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
session_start();
$id2 = $_SESSION['id'];

if (isset($_POST['submit'])) {

    if ($conn->connect_errno) {
        echo "Failed to connect to database: " . $conn->connect_error;
        exit();
    } else {

        $imgDir = "./images";

        $tempName = $_FILES['image']['tmp_name'];
        $imgName = basename($_FILES['image']['name']);

        move_uploaded_file($tempName, "$imgDir/$imgName");

        $insert = " INSERT INTO `image_data`(`image`) VALUES('$imgName') ";

        if ($row = $conn->query($insert)) {
            $id = $conn->insert_id;

            $sql = "SELECT * FROM `image_data` WHERE `id` = '".$id."' ";

            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                $url = $row['image'];
                $url = $dom.'upload/images/'.$url;
            }
            $dbsql = "UPDATE `main2` SET `url` = '".$url."' WHERE `main2`.`id` ='".$id2."' ; ";
            #send db update quary
            if ($conn->query($dbsql) === TRUE) {
                header( "Location: /succes.php" );
                $conn->close();
            }
        } else {
            die("Error: " . $conn->error);
        }
    }
}
