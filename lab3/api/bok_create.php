<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

require("../includes/conn_mysql.php");
require("../includes/bok_functions.php");

// Skapar databaskopplingen
$connection = dbConnect();

if(isset($_POST['bokTitel'])){
    $titel = $_POST['bokTitel'];
}else{
    echo "Ingen tillåten post (bokTitel)";
    exit;
}
if(isset($_POST['bokForfattare'])){
    $forfattare = $_POST['bokForfattare'];
}else{
    echo "Ingen tillåten post (bokForfattare)";
    exit;
}
if(isset($_POST['bokBeskrivn'])){
    $beskrivn = $_POST['bokBeskrivn'];
}else{
    echo "Ingen tillåten post (bokBeskrivn)";
    exit;
}
if(isset($_POST['bokIsbn'])){
    $isbn = $_POST['bokIsbn'];
}else{
    echo "Ingen tillåten post (bokIsbn)";
    exit;
}
if(isset($_POST['bokPris'])){
    $pris = $_POST['bokPris'];
}else{
    echo "Ingen tillåten post (bokPris)";
    exit;
}
if(isset($_POST['bokKategoriId'])){
    $bokkategori = $_POST['bokKategoriId'];
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
