<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$id = $_GET['id'];
$role = $_GET['role'];
if (isset($_GET['id_kelas'])) {
    $id_kelas = $_GET['id_kelas'];
}

$delete_data = $db->deleteData($conn->db, $role, $id);

if ($delete_data == true) {
    if ($role == "Mapel") {
        header("Location: ../View/view-data-mapel.php?menu={$role}");
    } else if ($role == "KodeKelas") {
        header("Location: ../View/view-data-kodekelas.php?menu={$role}");
    } else if ($role == "Kelas") {
        header("Location: ../View/view-data-kelas.php?id={$id_kelas}");
    } else {
        header("Location: ../View/view-data-user.php?menu={$role}");
    }
} else {
    session_start();
    $_SESSION["s_delete"] = "failed";
    if ($role == "Mapel") {
        header("Location: ../View/view-data-mapel.php?menu={$role}");
    } else if ($role == "Kelas") {
        header("Location: ../View/view-data-kodekelas.php?menu={$role}");
    } else if ($role == "Kelas") {
        header("Location: ../View/view-data-kelas.php?id={$id_kelas}");
    } else {
        header("Location: ../View/view-data-user.php?menu={$role}");
    }
}
