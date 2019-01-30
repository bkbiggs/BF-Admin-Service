<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$server='10.0.1.13';
$db = 'mydb';
$username = 'pi';
$password = 'gally4';

$id=$_REQUEST["id"];
$com=$_REQUEST["comName"];
$sci=$_REQUEST["sciName"];
$webData = $_REQUEST["webData"];
$webImage = $_REQUEST["webImage"];


try {
    $conn = new mysqli($server, $username, $password, $db );
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    return;
}

try {
    if ($id != null && $id != "") {
        $result = $conn->query("SELECT * FROM bird where id = $id");
    } else {
        die('Id is required.');
    }
}
catch(PDOException $e) {
    die('Could not get data: ' . $e->getMessage());
}

while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    $oldCom = $rs["commonName"];
    $oldSci = $rs["scientificName"];
}


if ( $com == "" || $com == null) {
    $newCom = $oldCom;
} else {
    $newCom = $com;
}

if ( $sci == "" || $sci == null) {
    $newSci = $oldSci;
} else {
    $newSci = $sci;
}


$sql = "UPDATE `mydb`.`bird` SET `commonName` = '$newCom', `scientificName` = '$newSci',
`webData` = '$webData',
`webImage` = '$webImage' WHERE `id` = '$id';";


try {
    // echo $sql."\n";
    $result = $conn->query( $sql );
}
catch(PDOException $e) {
    die('Could not get data: ' . $e->getMessage());
}

$conn->close();

// echo ($outp);
?>
