<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$server='10.0.1.13';
$db = 'mydb';
$username = 'pi';
$password = 'gally4';

// default entry would mean "all" entries
$id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : '';

header("Access-Control-Allow-Origin: *");

try {
    $conn = new mysqli($server, $username, $password, $db );
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    return;
}

try {
    if ($id != null && $id != "") {
        $result = $conn->query("SELECT * FROM birdPicture where id = $id");
    } else {
        $result = $conn->query("SELECT * FROM birdPicture");
        //  where (id > 370 and id < 390) limit 0,100");
    }
}
catch(PDOException $e) {
    die('Could not get data: ' . $e->getMessage());
}

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
      $outp .= '{"id":"'  . $rs["id"] . '",';
      $outp .= '"filename":"' . $rs["filename"] . '",';
      $outp .= '"sourceCamera":"' . $rs["sourceCamera"] . '",';
      $outp .= '"date":"' . $rs["date"] . '",';
      $outp .= '"time":"' . $rs["time"] . '",';
      $outp .= '"description":' . json_encode($rs["description"]) . ',';
      $outp .= '"lastUpdate":"' . $rs["lastUpdate"] . '",';
      $outp .= '"status":"'. $rs["status"]     . '"}';
}
$outp ='['.$outp.']';
$conn->close();

echo ($outp);

?>
