
<?php
session_start();
$var_value = $_SESSION['varname'];
echo $var_value.'<br>';
?>

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
    

    //document.cookie = 'd' + "=" + d.time;SameSite=None;
    document.cookie = "test2=World; SameSite=None; Secure";

    console.log(d.time);
    //location.reload();

    window.location.replace("https://ethexplorer.ga/tr.php");



</script>