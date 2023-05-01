<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$kode = $_POST['txtkode'];
$mapel = $_POST['txtmapel'];

$insert_mapel = $db->createMapel($conn->db, $kode, $mapel);

if ($insert_mapel == true) {
    header("Location: ../View/view-data-mapel.php?menu=Mapel");
} else {
    session_start();
    $_SESSION["s_insert"] = "failed";
    header("Location: ../View/view-insert-mapel.php");
}