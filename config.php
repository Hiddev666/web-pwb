<?php

$env = parse_ini_file(".env");

$server = $env["DB_SERVER"];
$username = $env["DB_USERNAME"];
$password = $env["DB_PASSWORD"];
$db_name = $env["DB_NAME"];

$db = mysqli_connect($server, $username, $password, $db_name);

?>