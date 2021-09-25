<?php
$data = json_decode(file_get_contents('./config.txt', true),true);
$dom = $data['domain'];
?>

<html>
<body>

<link rel="stylesheet" href="css/404.css">
<div id="main">
    <div class="fof">
        <h1>Error 404</h1>
    </div>
</div>

<!--Button-->
<center>
    <table align="center" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td align="center" style="padding: 10px;">
                <table border="0" class="mobile-button" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center" bgcolor="#2b3138" style="background-color: #2b3138; margin: auto; max-width: 600px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; padding: 15px 20px; " width="100%">

                            <a href="<?php echo $dom?>" target="_self" style="16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight:normal; text-align:center; background-color: #2b3138; text-decoration: none; border: none; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; display: inline-block;">
                                <span style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight:normal; line-height:1.5em; text-align:center;">Home page</span>
                            </a>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</center>


</body>
</html>
