<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] != "Guru") {
    header("Location: index.php");
}

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$id = $_GET['id'];

$dt_jadwal = $db->selectJoinJadwalById($conn->db, $id);
$db_kelas = $db->selectJoinKelasById($conn->db, $id);

if (!$dt_jadwal) {
    header("Location: view-data-jadwal.php?menu=Jadwal");
}

$hari = array();
$waktu = array();

foreach ($dt_jadwal as $key) {
    $nip = $key['nip'];
    $nama_guru = $key['nama_guru'];
    $kode_kelas = $key['kode_kelas'];
    array_push($hari, $key['hari']);
    array_push($waktu, $key['jam']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas
        <?= $kode_kelas ?> | Staff
    </title>

    <style>
        table,
        tr,
        td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h1>
        Data Kelas <?= $kode_kelas ?>
    </h1>
    <a href="view-data-jadwal.php?menu=Kelas">Back</a>
    <br>
    <table>
        <b>Siswa:</b>
        <tr>
            <th>NIS</th>
            <th>Nama Siswa</th>
        </tr>
        <?php
        if (count($db_kelas) == 0) {
            ?>
            <tr>
                <td colspan="2">
                    <i>No record.</i>
                </td>
            </tr>
            <?php
        } else {
            foreach ($db_kelas as $key) {
                ?>
                <tr>
                    <td>
                        <?= $key['nis'] ?>
                    </td>
                    <td>
                        <?= $key['nama_siswa'] ?>
                    </td>
                </tr>
                <?php
            }
        }

        ?>
    </table>
</body>

</html>