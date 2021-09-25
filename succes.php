<?php
session_start();
$aurl = $_SESSION['aurl'];
$log = $_SESSION['log'];

$data = json_decode(file_get_contents('./config.txt', true),true);
$dom = $data['domain'];
$logurl = $dom."acces.php?log=".$log."&track=insert";


?>


<html>
<body>

<center><h2>Your track url is </h2><a href="<?php echo $aurl ?>"><?php echo $aurl ?></a>

<h3>Your acces code is </h3><a href="<?php echo $logurl?>"><?php echo $log ?></a>
<br>
    <br>
    <a href="<?php echo $dom?>">
        <button>Visit Home page</button>
    </a>

</center>
</body>


</html>
