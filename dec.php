<?php
$jsonobj = '{"ip":"127.0.0.1","os":"Windows 10","arh":"amd64","br":"Firefox 92.0","time":"11:40:47 2021-09-18","city":null,"region":null,"regioncode":null,"country":null,"countrycode":null,"lat":null,"long":null,"acu":null,"timezone":"Europe/Moscow","dev":"Not detected","ba":"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:92.0) Gecko/20100101 Firefox/92.0"}';

$obj = json_decode($jsonobj);

echo $obj->os;