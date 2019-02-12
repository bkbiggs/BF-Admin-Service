<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$server='10.0.1.13';
$db = 'mydb';
$username = 'pi';
$password = 'gally4';

// $id=$_REQUEST["id"];
$birdId=$_REQUEST["birdId"];
$imageId=$_REQUEST["imageId"];


try {
    $conn = new mysqli($server, $username, $password, $db );
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    return;
}


$sql = "INSERT INTO `mydb`.`link`
( `birdId`, `imageId`)
VALUES
( '$birdId', '$imageId');";


try {
    // echo $sql."\n";
    $result = $conn->query( $sql );
    // echo $result."\n";
}
catch(PDOException $e) {
    die('Could not add entry: ' . $e->getMessage());
}

$conn->close();

// echo ($outp);
?>
