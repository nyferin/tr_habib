<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();


$id = $_POST['txtid'];
$hari1 = $_POST['txthari1'];
$jam1 = $_POST['txtjam1'];
$hari2 = $_POST['txthari2'];
$jam2 = $_POST['txtjam2_1'] . "-" . $_POST['txtjam2_2'];

$check_jadwal = $db->selectJoinJadwalById($conn->db, $id);

$update_jadwal = true;
foreach ($check_jadwal as $key) {
    if ($key['hari'] == $hari2 and $key['jam'] == $jam2) {
        $update_jadwal = false;
        break;
    }
}

if ($update_jadwal) {
    $update_kelas = $db->updateJadwalWaktu($conn->db, $hari1, $jam1, $hari2, $jam2, $id);
}

if ($update_jadwal == true) {
    header("Location: ../View/view-data-kelas.php?id={$id}");
} else {
    session_start();
    $_SESSION["s_update"] = "failed";
    header("Location: ../View/view-edit-jadwal-waktu.php?id={$id}&hari={$hari1}&jam={$jam1}");
}