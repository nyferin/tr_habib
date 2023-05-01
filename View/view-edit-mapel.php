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
$role = "Mapel";

$dt_mapel = $db->selectAllById($conn->db, $role, $id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data <?= $dt_mapel['mapel'] ?> | Staff</title>
</head>

<body>
    <h1>
        Edit Data <?= $dt_mapel['mapel'] ?>
    </h1>
    <a href="view-data-mapel.php?menu=Mapel">Back</a>

    <form action="../Controller/controller-edit-mapel.php" method="post">
        <table>
            <input type="text" name="txtid" id="" value="<?= $db_dt['id'] ?>" hidden readonly>
            <tr>
                <td>Kode</td>
                <td><input type="text" name="txtkode" id="" value="<?= $dt_mapel['kode'] ?>" required></td>
            </tr>
            <tr>
                <td>Mata Pelajaran</td>
                <td><input type="text" name="txtmapel" id="" value="<?= $dt_mapel['mapel'] ?>" autocomplete="off" required></td>
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