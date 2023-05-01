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

$db_guru = $db->selectDataUser($conn->db, "Guru");

$dt_jadwal = $db->selectJoinJadwalById($conn->db, $id);
foreach ($dt_jadwal as $key) {
    $nip = $key['nip'];
    $nama_guru = $key['nama_guru'];
    $kode_kelas = $key['kode_kelas'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengajar
        <?= $kode_kelas ?> | Staff
    </title>
</head>

<body>
    <h1>
        Edit Pengajar
        <?= $kode_kelas ?>
    </h1>
    <a href="view-data-kelas.php?id=<?= $id ?>">Back</a>

    <form action="../Controller/controller-edit-jadwal-guru.php" method="post">
        <table>
            <input type="text" name="txtkelas" id="" value="<?= $id ?>" hidden readonly>
            <tr>
                <td>NIP</td>
                <td>
                    <input type="text" name="txtguru" id="" list="guru" autocomplete="off" value="<?= $nip ?>" required>
                    <datalist id="guru">
                        <?php
                        foreach ($db_guru as $key) {
                            ?>
                            <option value="<?= $key['nip'] ?>">
                                <?= $key['nip'] . "-" . $key['nama'] ?>
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