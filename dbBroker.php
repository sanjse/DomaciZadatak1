<?php
$host = "localhost";
$db = "domacizadatak1";
$user = "root";
$pass = "";
$conn = new mysqli($host,$user,$pass,$db);

if ($conn->connect_errno){
    exit("Unsuccessful connection: error> ".$conn->connect_error.", err kod>".$conn->connect_errno);
}

?>