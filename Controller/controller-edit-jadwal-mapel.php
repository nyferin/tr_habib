<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$kode = $_POST['txtkode'];
$kelas = $_POST['txtkelas'];
$mapel = $_POST['txtmapel'];

$nama_mapel = $db->selectByCode($conn->db, "Mapel", $mapel);
$mapel = $nama_mapel['id'];

$update_kelas = $db->updateMapelJadwal($conn->db, $kelas, $mapel, $kode);

if ($update_kelas == true) {
    header("Location: ../View/view-data-jadwal.php?menu=Kelas");
} else {
    session_start();
    $_SESSION["s_update"] = "failed";
    header("Location: ../View/view-insert-jadwal.php");
}