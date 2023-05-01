<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$id = $_GET['id'];
$hari = $_GET['hari'];
$jam = $_GET['jam'];

$delete_data = $db->deleteJadwalWaktu($conn->db, $id, $hari, $jam);

if ($delete_data == true) {
    header("Location: ../View/view-data-kelas.php?id={$id}");
} else {
    session_start();
    $_SESSION["s_delete"] = "failed";
    header("Location: ../View/view-data-kelas.php?kode={$id}");
}