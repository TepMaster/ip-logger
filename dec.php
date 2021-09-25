<?php
//$file = file_get_contents('./config.txt', true);
$data = json_decode(file_get_contents('./config.txt', true),true);
echo $data['db'];
?>