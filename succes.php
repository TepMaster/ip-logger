<?php
session_start();
$aurl = $_SESSION['aurl'];
$log = $_SESSION['log'];


?>


<html>
<body>

<center><h2>Your track url is </h2><a href="<?php echo $aurl ?>"><?php echo $aurl ?></a>

<h3>Your acces code is </h3><a href="<?php echo $log ?>"><?php echo $log ?></a>
<br>
    <br>
    <a href="https://ethexplorer.ga/">
        <button>Visit Home page</button>
    </a>

</center>
</body>


</html>
