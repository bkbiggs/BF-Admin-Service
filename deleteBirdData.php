<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$server='10.0.1.13';
$db = 'mydb';
$username = 'pi';
$password = 'gally4';

$id=$_REQUEST["id"];


try {
    $conn = new mysqli($server, $username, $password, $db );
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    return;
}

try {
    if ($id != null && $id != "") {
        $result = $conn->query("SELECT * FROM mydb.bird where id = $id");
    } else {
        die('Id is required.');
    }
}
catch(PDOException $e) {
    die('Could not delete data: ' . $e->getMessage());
}



$sql = "DELETE from `mydb`.`bird` WHERE (`id` = '$id')";

try {
    // echo $sql."\n";
    $result = $conn->query( $sql );
}
catch(PDOException $e) {
    die('Could not delete entry: ' . $e->getMessage());
}

$conn->close();

// echo ($outp);
?>