<?php
    function generateRandomString($length = 7) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function genlog($length = 7) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

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
$dis = null;
$redirect = null;
/*
 * DEBUG MODE
 */
$debug = 0;



$rec =  "$_SERVER[REQUEST_URI]";
$ac = str_replace('/','',$rec);

/*####################################################################################################################
 *
 *                                  CREATE LINK
 *
 * ####################################################################################################################
 */
if (!empty($_POST['cr'])) {

    $acces = generateRandomString();
    $log = genlog();
    $ip = $_SERVER['REMOTE_ADDR'];
    $dis = $_POST['dis'];
    $redirect =  $_POST['aa'];
    $time = date("H:i:s")." ".date("Y/m/d");
    echo $dis;
    echo $redirect;
    $sql = "INSERT INTO main2 (acces, log, makeip,crdate,url,discord)
VALUES ('$acces', '$log', '$ip','$time','$redirect','$dis')";

    if ($conn->query($sql) === TRUE) {
        $aurl = "https://ethexplorer.ga/".$acces;
        session_start();
        $_SESSION['aurl'] = $aurl;
        $_SESSION['log'] = $log;
        header( "Location: /succes.php" );


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}
/*####################################################################################################################
 *
 *                                           ACCES LOG
 *
 * ####################################################################################################################
 */
if (isset($_POST['submit'])) {
    $searchValue = $_POST['search'];
        if ($conn->connect_error) {
        echo "connection Failed: " . $conn->connect_error;
    } else {
        $sql = "SELECT * FROM main2 WHERE acces LIKE '%$searchValue%'";

        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo $row['acces'] . "<br>";
            echo $row['log'] . "<br>";
            session_start();
            $_SESSION['acces'] = $row['acces'];
            $_SESSION['log'] = $row['log'];
            
           header( 'Location: /acces.php' );
        }
        }
}
/*####################################################################################################################
 *
 *                                  ACTUAL LOGGING
 *
 * ####################################################################################################################
 */
echo $ac;

if(strlen($ac) == '7')
{
    if ($conn->connect_error) {
        echo "connection Failed: " . $conn->connect_error;
    } else {
        if($debug)
        {
            echo $row['acces'] ."<br>";
            echo $row['log'] ."<br>";
            echo $row['id'] ."<br>";
            echo $row['discord'] ."<br>";
            echo $row['url'] ."<br>";
        }
        $sql = "SELECT * FROM `main2` WHERE `acces` LIKE '%$ac%' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row

            while($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $xurl = $row['acces'];

                if($xurl == $ac){
                    setcookie('id',$id);
                    header( "Location: /get-data.php" );

                }
               ;


            }
        } else {
            echo 'redirect';
           // header("Location: /404.php");
        }
    }

}

?>


<html>
<head>
        <link rel="stylesheet" href="css/index.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<center>
    <form action="" method="post" >
        <br>
        <br>
        <br>
        <br>
        <input type="text" name="aa" size="55" id="aa" class="url" placeholder="Redirect URL">
        <p>

            <input type="text" name="dis" size="35"  placeholder="Discord token-Optional">
        </p>
        <input type="hidden" name="cr" value="run">
        <input type="submit" value="Create track url!">
    </form>
</center>
<br>
<center>
<form action="" method="post">
    <input type="text" placeholder="Search" name="search">
    <button type="submit" name="submit">Search</button><br>
</form>


</center>


</form>
</body>
</html>
</body>
</html>
