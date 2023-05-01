<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();


$kelas = $_POST['txtkelas'];
$guru = $_POST['txtguru'];

$hari_1 = $_POST['txthari1'];
$jam_1 = $_POST['txtjam1_1'] . "-" . $_POST['txtjam1_2'];

$hari_2 = $_POST['txthari2'];
$jam_2 = $_POST['txtjam2_1'] . "-" . $_POST['txtjam2_2'];
if ($hari_2 == "") {
    $jam_2 = "";
} else {
    $jam_3 = $_POST['txtjam3_1'] . "-" . $_POST['txtjam3_2'];
}

$hari_3 = $_POST['txthari3'];
if ($hari_3 == "") {
    $jam_3 = "";
} else {
    $jam_3 = $_POST['txtjam3_1'] . "-" . $_POST['txtjam3_2'];
}

$dt_kodekelas = $db->selectByCode($conn->db, "KodeKelas", $kelas);
$kelas = $dt_kodekelas['id'];

$check_jadwal = $db->selectJoinJadwalById($conn->db, $kelas);

$insert_jadwal = true;

if ($hari_1 == $hari_2 and $jam_1 == $jam_2 or $hari_1 == $hari_3 and $jam_1 == $jam_3 or $hari_2 == $hari_3 and $jam_2 == $jam_3) {
    $insert_jadwal = false;
}

foreach ($check_jadwal as $key) {
    if ($key['hari'] == $hari_1 and $key['jam'] == $jam_1 or $key['hari'] == $hari_2 and $key['jam'] == $jam_2 or $key['hari'] == $hari_3 and $key['jam'] == $jam_3) {
        $insert_jadwal = false;
        break;
    }
}

if ($insert_jadwal) {
    $nis_guru = $db->selectByCode($conn->db, "Guru", $guru);
    $guru = $nis_guru['id'];

    $kodekelas = $db->selectByCode($conn->db, "KodeKelas", $kelas);
    $kelas = $kodekelas['id'];


    if ($hari_2 == "" and $hari_3 == "") {

        $insert_jadwal = $db->createJadwal($conn->db, $kelas, $guru, $hari_1, $jam_1);
    } else if ($hari_2 != "" and $hari_3 == "") {
        $insert_jadwal = $db->createJadwal($conn->db, $kelas, $guru, $hari_1, $jam_1);
        $insert_jadwal = $db->createJadwal($conn->db, $kelas, $guru, $hari_2, $jam_2);
    } else if ($hari_2 == "" and $hari_3 != "") {
        $insert_jadwal = $db->createJadwal($conn->db, $kelas, $guru, $hari_1, $jam_1);
        $insert_jadwal = $db->createJadwal($conn->db, $kelas, $guru, $hari_3, $jam_3);
    } else {
        $insert_jadwal = $db->createJadwal($conn->db, $kelas, $guru, $hari_1, $jam_1);
        $insert_jadwal = $db->createJadwal($conn->db, $kelas, $guru, $hari_2, $jam_2);
        $insert_jadwal = $db->createJadwal($conn->db, $kelas, $guru, $hari_3, $jam_3);
    }
}

if ($insert_jadwal == true) {
    header("Location: ../View/view-data-jadwal.php?menu=Jadwal");
} else {
    session_start();
    $_SESSION["s_insert"] = "failed";
    header("Location: ../View/view-insert-jadwal.php");
}