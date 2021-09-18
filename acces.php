<?php
if ($_GET) {
    if (isset($_GET['track'])) {

        $log = $_GET['log'];
        $rawdata = null;
        $data = null;
        #DB
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


        $sql = "SELECT * FROM `main2` WHERE `log` LIKE '%$log%' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

                $rawdata = $row['data'];
            }
        } else {
            echo "0 results";
        }

        $jdec = json_decode($rawdata,true);
        $i = '0';
        if($rawdata == null){
            echo 'no records found';
        }else
        {
            foreach ($jdec as &$value) {


                echo 'IP: '.$value['ip'].'<br>';
                echo 'Arhicteture: '.$value['arh'].'<br>';
                echo 'Browser: '.$value['br'].'<br>';
                echo 'Time-UTC: '.$value['time'].'<br>';
                echo 'Region: '.$value['region'].'<br>';
                echo 'Region Code: '.$value['regioncode'].'<br>';
                echo 'Country: '.$value['country'].'<br>';
                echo 'Country code: '.$value['countrycode'].'<br>';
                echo 'Latitude(ip): '.$value['lat'].'<br>';
                echo 'Longitude(ip): '.$value['long'].'<br>';
                echo 'Accuracy(mil)(ip): '.$value['acu'].'<br>';
                echo 'Timezone: '.$value['timezone'].'<br>';
                echo 'Device: '.$value['dev'].'<br>';
                echo 'UserAgent: '.$value['ba'].'<br>';
                echo '========================================================================='.'<br><br><br><br>';



            }



        }




    }
}else
{

    header("Location: /404.php");
}




?>