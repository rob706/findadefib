<?php

## Environment Settings ##

$mainurl = "xxx";

## DB Settings ##

$server = "localhost";
$db = "xxx";

## Read User

$user = "xxx";
$pass = "xxx";

## Update User - If you want a seperate update user

$user_u = $user;
$pass_u = $pass;

$secret = "xxxxx";

$fromd = date("Y-m-d H:i:s", strtotime(date("Y-m-d"))-(60*60*24*7));

$conn = new mysqli($server, $user, $pass, $db);
$conn_update = new mysqli($server, $user_u, $pass_u, $db);

## Google Maps Integration

$GM_MapsAPIKey = "xxxxx";

?>
