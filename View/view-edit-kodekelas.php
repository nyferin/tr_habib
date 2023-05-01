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

$dt_kelas = $db->selectAllById($conn->db, "KodeKelas", $id);

$dt_mapel = $db->selectAllById($conn->db, "Mapel", $dt_kelas['id_mapel']);

$db_mapel = $db->selectAllData($conn->db, "Mapel")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kode Kelas <?= $dt_kelas['kode'] ?> | Staff
    </title>
</head>

<body>
    <h1>
        Edit Kode Kelas <?= $dt_kelas['kode'] ?>
    </h1>
    <a href="view-data-kodekelas.php?menu=KodeKelas">Back</a>

    <form action="../Controller/controller-edit-kodekelas.php" method="post">
        <table>
            <input type="text" name="txtid" id="" value="<?= $id ?>" hidden readonly>
            <tr>
                <td>Kode Kelas</td>
                <td>
                    <input type="text" name="txtkelas" id="" autocomplete="off" value="<?= $dt_kelas['kode'] ?>"
                        required>
                    </datalist>
                </td>
            </tr>
            <tr>
                <td>Kode Mapel</td>
                <td>
                    <input type="text" name="txtmapel" id="" list="mapel" autocomplete="off"
                        value="<?= $dt_mapel['kode'] ?>" required>
                    <datalist id="mapel">
                        <?php
                        foreach ($db_mapel as $key) {
                            ?>
                            <option value="<?= $key['kode'] ?>">
                                <?= $key['kode'] . "-" . $key['mapel'] ?>
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