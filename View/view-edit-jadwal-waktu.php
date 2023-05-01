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
$hari = $_GET['hari'];
$jam = $_GET['jam'];
$jam1 = substr($jam, 0, 5);
$jam2 = substr($jam, 6);

$dt_jadwal = $db->selectJoinJadwalById($conn->db, $id);
foreach ($dt_jadwal as $key) {
    $kode_kelas = $key['kode_kelas'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Waktu Kelas
        <?= $kode_kelas ?> | Staff
    </title>
</head>

<body>
    <h1>
        Edit Waktu Kelas
        <?= $kode_kelas ?>
    </h1>
    <a href="view-data-kelas.php?id=<?= $id ?>">Back</a>

    <form action="../Controller/controller-edit-jadwal-waktu.php" method="post">
        <table>
            <input type="text" name="txtid" id="" value="<?= $id ?>" hidden readonly>
            <input type="text" name="txthari1" id="" value="<?= $hari ?>" hidden readonly>
            <input type="text" name="txtjam1" id="" value="<?= $jam ?>" hidden readonly>
            <tr>
                <td>Hari</td>
                <td>
                    <input type="text" name="txthari2" id="" list="hari" autocomplete="off" value="<?= $hari ?>"
                        required>
                    <datalist id="hari">
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </datalist>
                </td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>
                    <input type="time" name="txtjam2_1" id="" autocomplete="off" value="<?= $jam1 ?>" required> s.d.
                    <input type="time" name="txtjam2_2" id="" autocomplete="off" value="<?= $jam2 ?>" required>
                </td>
            </tr>
            <?php
            if (isset($_SESSION["s_update"]) and $_SESSION["s_update"] == "failed") {
                ?>
                <tr>
                    <td></td>
                    <td>
                        <i style="color:red;">Update gagal!</i>
                    </td>
                </tr>
                <?php
                unset($_SESSION['s_update']);
            }
            ?>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Save">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>