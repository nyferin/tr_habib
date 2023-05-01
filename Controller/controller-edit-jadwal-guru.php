<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$kelas = $_POST['txtkelas'];
$guru = $_POST['txtguru'];

$nama_guru = $db->selectByCode($conn->db, "Guru", $guru);
$guru = $nama_guru['id'];

$update_kelas = $db->updateJadwalGuru($conn->db, $guru, $kelas);

if ($update_kelas == true) {
    header("Location: ../View/view-data-kelas.php?id={$kelas}");
} else {
    session_start();
    $_SESSION["s_update"] = "failed";
    header("Location: ../View/view-edit-jadwal-guru.php?id={$kelas}");
}