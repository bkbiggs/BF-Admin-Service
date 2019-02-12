<?php
$servername = '10.0.1.13';
$db = 'mydb';
$username = 'pi';
$password = 'gally4';
$charset = 'utf8mb4';

$dsn = "mysql:host=$servername;dbname=$db;charset=$charset";


header("Access-Control-Allow-Origin: *");

$opt = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_AUTOCOMMIT => false,
];

try {
    $conn = new PDO($dsn, $username, $password, $opt);
    // set the PDO error mode to exception
    echo "Connected successfully<br/>\n"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    return;
    }


$id=$_REQUEST["id"];
$filename=$_REQUEST["filename"];
$camera=$_REQUEST["camera"];
$date=$_REQUEST["date"];
$time = $_REQUEST["time"];
$desc = $_REQUEST["desc"];
$lastUpdate = $_REQUEST["lastUpdate"];
$status = $_REQUEST["status"];


$sql = "UPDATE `mydb`.`birdPicture` SET `filename` = '$filename', `sourceCamera` = '$camera', `date` = '$date',
`time` = '$time', `description` = '$desc', `lastUpdate` = '$lastUpdate', 
`status` = '$status' WHERE `id` = '$id';";

try {
    // echo "<!-- ".$sql." -->\n";
    $result = $conn->query( $sql );
}
catch(PDOException $e) {
    die('Could not get data: ' . $e->getMessage());
}

// $conn->close();
$conn = null;

?>
