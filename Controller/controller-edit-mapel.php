<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$id = $_POST['txtid'];
$kode = $_POST['txtkode'];
$mapel = $_POST['txtmapel'];

$update_mapel = $db->updateDataMapel($conn->db, $kode, $mapel, $id);

if ($update_mapel == true) {
    header("Location: ../View/view-data-mapel.php?menu=Mapel");
} else {
    session_start();
    $_SESSION["s_update"] = "failed";
    header("Location: ../View/view-edit-mapel.php?id={$id}");
}
