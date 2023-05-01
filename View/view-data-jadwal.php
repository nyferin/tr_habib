<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] != "Staff") {
    header("Location: index.php");
}

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$menu = $_GET['menu'];

$db_jadwal = $db->selectJoinJadwalUnique($conn->db);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Jadwal | Staff
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
        Data Jadwal
    </h1>
    <a href="view-home-staff.php">Back</a>

    <table>
        <tr>
            <th>Kode</th>
            <th>Mapel</th>
            <th>Guru</th>
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
            foreach ($db_jadwal as $key) {
                ?>
                <tr>
                    <td>
                        <a href="view-data-kelas.php?id=<?= $key['id'] ?>"><?= $key['kode_kelas'] ?></a>
                    </td>
                    <td>
                        <?= $key['mapel'] ?>
                    </td>
                    <td>
                    <?= $key['nip'] ?> - <?= $key['nama_guru'] ?>
                    </td>
                </tr>
                <?php
            }
        }

        ?>
    </table>
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
    <a href="view-insert-jadwal.php">
        <button>add</button>
    </a>
</body>

</html>