<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] != "Staff") {
    header("Location: index.php");
}

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$id_kelas = $_GET['id_kelas'];
$id_siswa = $_GET['id_siswa'];

$db_siswa = $db->selectDataUser($conn->db, "Siswa");

$dt_siswa = $db->selectUserById($conn->db, "Siswa", $id_siswa);

$dt_jadwal = $db->selectJoinJadwalById($conn->db, $id_kelas);
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
    <title>Edit Siswa Kelas <?= $kode_kelas ?> | Staff
    </title>
</head>

<body>
    <h1>
        Data Kelas
    </h1>
    <a href="view-data-kelas.php?id=<?= $id_kelas ?>">Back</a>

    <form action="../Controller/controller-edit-kelas.php" method="post">
        <table>
            <input type="text" name="txtid" id="" value="<?= $id_kelas ?>" hidden readonly>
            <tr>
                <td>NIS</td>
                <td>
                    <input type="text" name="txtsiswa" id="" list="siswa" value="<?= $dt_siswa['nis'] ?>" autocomplete="off">
                    <datalist id="siswa">
                        <?php
                        foreach ($db_siswa as $key) {
                            ?>
                            <option value="<?= $key['nis'] ?>">
                                <?= $key['nis'] . "-" . $key['nama'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </datalist>
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