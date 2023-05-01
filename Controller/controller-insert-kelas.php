<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();


$id = $_POST['txtid'];
$siswa = $_POST['txtsiswa'];

$check_kelas = $db->selectJoinKelasByid($conn->db, $id);

$insert_kelas = true;
foreach ($check_kelas as $key) {
    if ($key['nis'] == $siswa) {
        $insert_kelas = false;
        break;
    }

}

if ($insert_kelas) {
    $dt_siswa = $db->selectByCode($conn->db, "Siswa", $siswa);
    $siswa = $dt_siswa['id'];

    $insert_kelas = $db->createKelas($conn->db, $siswa, $id);
}

if ($insert_kelas == true) {
    header("Location: ../View/view-data-kelas.php?id={$id}");
} else {
    session_start();
    $_SESSION["s_insert"] = "failed";
    header("Location: ../View/view-insert-kelas.php?id={$id}");
}