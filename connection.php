<?php 

$servernameDB = "localhost";
$usernameDB = "root";
$passwordDB = "";
$dbnameDB = "classicmodels";

mysqli_report(MYSQLI_REPORT_OFF);

$connection = new mysqli($servernameDB,$usernameDB,$passwordDB,$dbnameDB);

if ($connection->connect_error) {
    header("Location: error.html");
    exit;
}

?>