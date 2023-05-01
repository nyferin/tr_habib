<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();


$id = $_POST['txtid'];
$guru = $_POST['txtguru'];

$hari = $_POST['txthari'];
$jam = $_POST['txtjam1'] . "-" . $_POST['txtjam2'];

$check_jadwal = $db->selectJoinJadwalById($conn->db, $id);

$insert_jadwal = true;
foreach ($check_jadwal as $key) {
    if ($key['hari'] == $hari and $key['jam'] == $jam) {
        $insert_jadwal = false;
        break;
    }
}

if ($insert_jadwal) {
    $nis_guru = $db->selectByCode($conn->db, "Guru", $guru);
    $guru = $nis_guru['id'];

    $insert_jadwal = $db->createJadwal($conn->db, $id, $guru, $hari, $jam);
}

if ($insert_jadwal == true) {
    header("Location: ../View/view-data-kelas.php?id={$id}");
} else {
    session_start();
    $_SESSION["s_insert"] = "failed";
    header("Location: ../View/view-insert-jadwal-waktu.php?id={$id}");
}