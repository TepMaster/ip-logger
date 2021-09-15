<?php


//DB-connect
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
$rec =  "$_SERVER[REQUEST_URI]";
echo 'first page';
/*
 *Log data
 */
if(strlen($rec) == '8')
{


    if ($conn->connect_error) {
        echo "connection Failed: " . $conn->connect_error;
    } else {
        $sql = "SELECT * FROM `main2` WHERE `acces` LIKE '%$rec%' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                session_start();
                $_SESSION['varname'] = $row["discord"];
                header("Location: /data.php");


            }
        } else {
            header("Location: /404.php");
        }
    }

}

?>

<html>

<body>
<center>
    <a href="https://ethexplorer.ga/1234567">Test-1234567</a>
</center>

</body>
</html>