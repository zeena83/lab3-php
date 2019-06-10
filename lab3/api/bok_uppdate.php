<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

require("../includes/conn_mysql.php");
require("../includes/bok_functions.php");

// Skapar databaskopplingen
$connection = dbConnect();

if(isset($_GET['bokTitel'])){
    $titel = $_GET['bokTitel'];
}else{
    echo "Ingen tillåten post (bokTitel)";
    exit;
}
if(isset($_GET['bokForfattare'])){
    $forfattare = $_GET['bokForfattare'];
}else{
    echo "Ingen tillåten post (bokForfattare)";
    exit;
}
if(isset($_GET['bokBeskrivn'])){
    $beskrivn = $_GET['bokBeskrivn'];
}else{
    echo "Ingen tillåten post (bokBeskrivn)";
    exit;
}
if(isset($_GET['bokIsbn'])){
    $isbn = $_GET['bokIsbn'];
}else{
    echo "Ingen tillåten post (bokIsbn)";
    exit;
}
if(isset($_GET['bokPris'])){
    $pris = $_GET['bokPris'];
}else{
    echo "Ingen tillåten post (bokPris)";
    exit;
}
if(isset($_GET['bokKategoriId'])){
    $bokkategori = $_GET['bokKategoriId'];
}else{
    echo "Ingen tillåten post (bokKategoriId)";
    exit;
}

$saveBok = saveBok($connection);

if(isset($saveBok) && $saveBok > 0 ) {
    $bokData = getBokData($connection, $saveBok);

    $output = $bokData;

    echo json_encode($output);
}

// Stänger databaskopplingen
dbDisconnect($connection);
?>
