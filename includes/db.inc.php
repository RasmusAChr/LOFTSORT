<?php

$config = parse_ini_file('config.ini');

$hostName = $config['hostName'];
$userName = $config['userName'];
$password = $config['password'];
$dbName = $config['dbName'];

$conn = new mysqli($hostName, $userName, $password, $dbName);
if (!$conn) {
   echo "not connected";
}

?>