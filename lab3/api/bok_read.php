<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

require("../includes/conn_mysql.php");
require("../includes/bok_functions.php");

// Skapar databaskopplingen
$connection = dbConnect();

if(isset($_GET['bokId']) && $_GET['bokId'] > 0 ){
    $bokData = getBokData($connection,$_GET['bokId']);
}else{
    echo "Inget giltligt ID";
}

$output = $bokData;

echo json_encode($output);

// Stänger databaskopplingen
dbDisconnect($connection);
?>
