<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();


$kelas = $_POST['txtkelas'];
$mapel = $_POST['txtmapel'];

$insert_kelas = true;

$check_kodekelas = $db->selectAllData($conn->db, "KodeKelas");
foreach ($check_kodekelas as $key) {
    if ($key['kode'] == $kelas) {
        $insert_kelas = false;
        break;
    }
}

if ($insert_kelas) {
    $kode_mapel = $db->selectByCode($conn->db, "Mapel", $mapel);
    $mapel = $kode_mapel['id'];

    $insert_kelas = $db->createKodeKelas($conn->db, $kelas, $mapel);
}

if ($insert_kelas == true) {
    header("Location: ../View/view-data-kodekelas.php?menu=KodeKelas");
} else {
    session_start();
    $_SESSION["s_insert"] = "failed";
    header("Location: ../View/view-insert-kodekelas.php");
}