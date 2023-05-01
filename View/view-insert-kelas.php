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

$db_siswa = $db->selectDataUser($conn->db, "Siswa");
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
    <title>Insert Siswa <?= $kode_kelas?> | Staff
    </title>
</head>

<body>
    <h1>
        Insert Siswa <?= $kode_kelas?>
    </h1>
    <a href="view-data-kelas.php?id=<?= $id ?>">Back</a>

    <form action="../Controller/controller-insert-kelas.php" method="post">
        <table>
            <input type="text" name="txtid" id="" value="<?= $id ?>" hidden readonly>
            <tr>
                <td>NIS</td>
                <td>
                    <input type="text" name="txtsiswa" id="" list="siswa" autocomplete="off" required>
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
            if (isset($_SESSION["s_insert"]) and $_SESSION["s_insert"] == "failed") {
                ?>
                <tr>
                    <td></td>
                    <td>
                        <i style="color:red;">Siswa gagal ditambahkan!</i>
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