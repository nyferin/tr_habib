<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] != "Staff") {
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

    <?php
    if (isset($_SESSION["s_delete"]) and $_SESSION["s_delete"] == "failed") {
        ?>
        <tr>
            <td></td>
            <td>
                <i style="color:red;">Delete gagal!</i>
            </td>
        </tr>
        <?php
        unset($_SESSION['s_delete']);
    }
    ?>

    <p>
        <b>Guru: </b><br>
        <?= $nip . " - " . $nama_guru ?>
        <a href="view-edit-jadwal-guru.php?id=<?= $id ?>">
            <button>edit</button>
        </a>
    </p>

    <table>
        <b>Jadwal:</b>
        <tr>
            <th>Hari</th>
            <th>Waktu</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        for ($i = 0; $i < count($dt_jadwal); $i++) {
            ?>
            <tr>
                <td>
                    <?= $hari[$i] ?>
                </td>
                <td>
                    <?= $waktu[$i] ?>
                </td>
                <td>
                    <a href="view-edit-jadwal-waktu.php?id=<?= $id ?>&hari=<?= $hari[$i] ?>&jam=<?= $waktu[$i] ?>">
                        <button>edit</button>
                    </a>
                </td>
                <td>
                    <a href="../Controller/controller-delete-waktu.php?id=<?= $id ?>&hari=<?= $hari[$i] ?>&jam=<?= $waktu[$i] ?>">
                        <button>delete</button>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <a href="view-insert-jadwal-waktu.php?id=<?= $id ?>">
        <button>add</button>
    </a>
    <br>
    <br>
    <table>
        <b>Siswa:</b>
        <tr>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        if (count($db_kelas) == 0) {
            ?>
            <tr>
                <td colspan="4">
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
                    <td>
                        <a href="view-edit-kelas.php?id_kelas=<?= $key['id_kelas'] ?>&id_siswa=<?= $key['id_siswa'] ?>">
                            <button>edit</button>
                        </a>
                    </td>
                    <td>
                        <a href="../Controller/controller-delete.php?id=<?= $key['id_siswa'] ?>&role=Kelas&id_kelas=<?= $key['id_kelas'] ?>">
                            <button>delete</button>
                        </a>
                    </td>
                </tr>
                <?php
            }
        }

        ?>
    </table>
    <a href="view-insert-kelas.php?id=<?= $id ?>">
        <button>add</button>
    </a>
</body>

</html>