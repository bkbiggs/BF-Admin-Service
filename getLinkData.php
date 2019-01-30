<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$server='10.0.1.13';
$db = 'mydb';
$username = 'pi';
$password = 'gally4';

// default entry would mean "all" entries
$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : '';

try {
    $conn = new mysqli($server, $username, $password, $db );
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    return;
}


try {
    if ($id != null && $id != "") {
        $result = $conn->query("SELECT * FROM link where id = $id");
    } else {
        $result = $conn->query("SELECT * FROM link");
    }
}
catch(PDOException $e) {
    die('Could not get data: ' . $e->getMessage());
}


$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"id":"'  . $rs["id"] . '",';
    $outp .= '"birdId":"'   . $rs["birdId"]        . '",';
    $outp .= '"imageId":"'. $rs["imageId"]     . '"}';
}
$outp ='['.$outp.']';
$conn->close();

echo ($outp);
?>
