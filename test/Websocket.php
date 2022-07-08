<?php

$random = strval(rand(1, 99999999)); 
$host = '127.0.0.1';
$port = 9090;
$str = strval($random.$host.$port);
echo PHP_EOL;
echo hash('sha1', $str);
echo PHP_EOL;