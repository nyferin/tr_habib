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
foreach ($dt_jadwal as $key) {
    $nip = $key['nip'];
    $kode_kelas = $key['kode_kelas'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Waktu Kelas
        <?= $kode_kelas ?> | Staff
    </title>
</head>

<body>
    <h1>
        Insert Waktu Kelas
        <?= $kode_kelas ?>
    </h1>
    <a href="view-data-kelas.php?id=<?= $id ?>">Back</a>

    <form action="../Controller/controller-insert-jadwal-waktu.php" method="post">
        <table>
            <input type="text" name="txtid" id="" value="<?= $id ?>" hidden readonly>
            <input type="text" name="txtguru" id="" value="<?= $nip ?>" hidden readonly>
            <tr>
                <td>Hari</td>
                <td>
                    <input type="text" name="txthari" id="" list="hari" autocomplete="off" required>
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
                    <input type="time" name="txtjam1" id="" autocomplete="off" value="<?= $jam1 ?>" required> s.d.
                    <input type="time" name="txtjam2" id="" autocomplete="off" required>
                </td>
            </tr>
            <?php
            if (isset($_SESSION["s_insert"]) and $_SESSION["s_insert"] == "failed") {
                ?>
                <tr>
                    <td></td>
                    <td>
                        <i style="color:red;">Waktu baru gagal ditambahkan!</i>
                    </td>
                </tr>
                <?php
                unset($_SESSION['s_insert']);
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