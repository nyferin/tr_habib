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
$role = $_GET['role'];

$db_dt = $db->selectAllById($conn->db, $role, $id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data <?= $db_dt['nama'] ?> | Staff</title>
</head>

<body>
    <h1>
        Data <?= $db_dt['nama'] ?>
    </h1>
    <a href="view-data-user.php?menu=<?= $role ?>">Back</a>

    <form action="../Controller/controller-edit-user.php" method="post">
        <table>
            <input type="text" name="txtid" id="" value="<?= $db_dt['id'] ?>" hidden readonly>
            <input type="text" name="txtrole" id="" value="<?= $db_dt['role'] ?>" hidden readonly>
            <tr>
                <td>NIP</td>
                <?php
            if ($role == "Siswa") {
                ?>
                <td><input type="text" name="txtni" id="" value="<?= $db_dt['nis'] ?>" autocomplete="off" required></td>
                <?php
            } else {
                ?>
                <td><input type="text" name="txtni" id="" value="<?= $db_dt['nip'] ?>" autocomplete="off" required></td>
                <?php
            }
            ?>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="txtnama" id="" value="<?= $db_dt['nama'] ?>" autocomplete="off" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="txtpassword" id="" value="" autocomplete="off"></td>
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