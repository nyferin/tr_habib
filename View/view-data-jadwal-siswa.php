<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] != "Siswa") {
    header("Location: index.php");
}

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$nis = $_SESSION['s_ni'];
$dt_user = $db->selectByCode($conn->db, "Siswa", $nis);

$id = $dt_user['id'];
$db_jadwal = $db->selectJoinJadwalByIdUser($conn->db, $id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Sekolah
        <?= $_SESSION["s_user"] ?> | Siswa
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
        Jadwal Sekolah
    </h1>
    <a href="view-home-siswa.php">Back</a>

    <table>
        <tr>
            <th>Kode Kelas</th>
            <th>Mapel</th>
            <th>Jam</th>
        </tr>
        <?php
        if (count($db_jadwal) == 0) {
            ?>
            <tr>
                <td colspan="3">
                    <i>No record.</i>
                </td>
            </tr>
            <?php
        } else {
            ?>
            <?php
            foreach ($db_jadwal as $key) {
                ?>
                <tr>
                    <th colspan="3">
                        <?= $key['hari'] ?>
                    </th>
                </tr>
                <tr>
                    <td>
                        <?= $key['kode_kelas'] ?>
                    </td>
                    <td>
                        <?= $key['mapel'] ?>
                    </td>
                    <td>
                        <?= $key['jam'] ?>
                    </td>
                </tr>
                <?php
            }
        }

        ?>
    </table>
</body>

</html>