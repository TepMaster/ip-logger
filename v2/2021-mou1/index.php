
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="js/ua-parser.js"></script>
<script type="text/javascript">
    var parser = new UAParser();
    var result = parser.getResult();
    var userID = Intl.DateTimeFormat().resolvedOptions().timeZone;
    var d = {};
    d.time = Intl.DateTimeFormat().resolvedOptions().timeZone;
    d.ba = result.ua;
    d.br = result.browser.name +' ' + result.browser.version;
    d.os = result.os.name + ' ' + result.os.version;

    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "script.php";
    var fn = 'blyat';
    var vars = "data="+JSON.stringify(d);
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.send(vars);
    //location.reload();


</script>
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
//setcookie('id',null,-1);

//DEBUG MODE
$debug = 0;




$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//Vars
$dis = '';
$redirect = '';

if (!empty($_GET['cr'])) {

    $acces = generateRandomString();
    $log = genlog();
    $ip = $_SERVER['REMOTE_ADDR'];
    $dis = $_REQUEST['dis'];
    $redirect =  $_POST['aa'];
    $time = date("H:i:s")." ".date("Y/m/d");
    echo $dis;
    echo $redirect;
    $sql = "INSERT INTO main2 (acces, log, makeip,crdate,url,discord)
VALUES ('$acces', '$log', '$ip','$time','$redirect','$dis')";

    if ($conn->query($sql) === TRUE) {
        $aurl = "https://ethexplorer.ga/".$acces;

        //displat
?>
        <center><h2>Your track url is </h2><a href="<?php echo $aurl ?>"><?php echo $aurl ?></a></center>

        <center><h3>Your acces code is </h3><a href="<?php echo $log ?>"><?php echo $log ?></a></center>

        <?php


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}
//acces logs
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
//LOG
$ac = str_replace('https://ethexplorer.ga/','',$actual_link);
//$ac = '';
//echo $ac.'<p>';
if(strlen($ac)== '7') {
    if ($conn->connect_error) {
        echo "connection Failed: " . $conn->connect_error;
    } else {
        $sql = "SELECT * FROM main2 WHERE acces LIKE '%$ac%'";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if($debug)
        {
            echo $row['acces'] ."<br>";
            echo $row['log'] ."<br>";
            echo $row['id'] ."<br>";
            echo $row['discord'] ."<br>";
            echo $row['url'] ."<br>";
        }
           
           // echo $row['id'] . "<br>";
            $id = $row['id'];


        }
        if($row['acces'] = $ac){
           // setcookie('discord', $ur);

                setcookie('id',$id);
            if($debug)
            {
                echo 'Redirected to /tr.php';
            }
            else
            {

                header( "Location: /tr.php" );
            }
            

        }



}
//Discord TOken managemat




?>


<html>
      <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<center><form action="index.php" method="get" >
        <br>
        <br>
        <br>
        <br>
        <input type="text" name="aa" size="55" maxlength="30" id="aa">
        <p>

            <input type="text" name="dis" size="35"maxlength="25"  placeholder="Discord token-Optional">
        </p>

    </form>
</center>



<center><form action="index.php" method="get">
        <input type="hidden" name="cr" value="run">
        <input type="submit" value="Create track url!">

    </form>

    <br>  </center>
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
