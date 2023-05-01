<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$id = $_POST['txtid'];
$kelas = $_POST['txtkelas'];
$mapel = $_POST['txtmapel'];

$kode_mapel = $db->selectByCode($conn->db, "Mapel", $mapel);
$mapel = $kode_mapel['id'];

$update_kelas = $db->updateKodeKelas($conn->db, $kelas, $mapel, $id);

if ($update_kelas == true) {
    header("Location: ../View/view-data-kodekelas.php?menu=KodeKelas");
} else {
    session_start();
    $_SESSION["s_update"] = "failed";
    header("Location: ../View/view-edit-kodekelas.php?id={$id}");
}