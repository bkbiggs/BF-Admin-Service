<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$server='10.0.1.13';
$db = 'mydb';
$username = 'pi';
$password = 'gally4';

// $id=$_REQUEST["id"];
$comName=$_REQUEST["comName"];
$sciName=$_REQUEST["sciName"];
$webData=$_REQUEST["webData"];
$webImage=$_REQUEST["webImage"];

// todo: add in the web image and web reference


try {
    $conn = new mysqli($server, $username, $password, $db );
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    return;
}


$sql = "INSERT INTO `mydb`.`bird`
( `commonName`, `scientificName`,  `webData`, `webImage`)
VALUES
('$comName', '$sciName', '$webData', '$webImage');";



try {
    echo $sql."\n";
    $result = $conn->query( $sql );
}
catch(PDOException $e) {
    die('Could not add entry: ' . $e->getMessage());
}

$conn->close();

// echo ($outp);
?>
