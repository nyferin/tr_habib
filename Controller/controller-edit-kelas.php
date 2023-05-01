<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$id = $_POST['txtid'];
$siswa = $_POST['txtsiswa'];

$check_kelas = $db->selectJoinKelasByid($conn->db, $id);

$update_kelas = true;
foreach ($check_kelas as $key) {
    if ($key['nis'] == $siswa) {
        $update_kelas = false;
        break;
    }

}

$dt_siswa = $db->selectByCode($conn->db, "Siswa", $siswa);
$siswa = $dt_siswa['id'];

if ($update_kelas) {
    $update_kelas = $db->createKelas($conn->db, $siswa, $id);
}

if ($update_kelas == true) {
    header("Location: ../View/view-data-kelas.php?id={$id}");
} else {
    session_start();
    $_SESSION["s_update"] = "failed";
    header("Location: ../View/view-edit-kelas.php?id_kelas={$id}&id_siswa={$siswa}");
}