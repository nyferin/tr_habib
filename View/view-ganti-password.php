<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] == "Staff") {
    header("Location: index.php");
}

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$ni = $_SESSION['s_ni'];
$role = $_SESSION['s_role'];

$dt_user = $db->selectByCode($conn->db, $role, $ni);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password | Guru</title>
</head>

<body>
    <h1>
        Ganti Password
    </h1>
    <a href="view-data-user.php?menu=<?= $role ?>">Back</a>

    <form action="../Controller/controller-ganti-password.php" method="post">
        <table>
            <input type="text" name="txtni" id="" value="<?= $ni ?>" hidden readonly>
            <input type="text" name="txtrole" id="" value="<?= $role ?>" hidden readonly>
            <tr>
                <td>Password lama</td>
                <td><input type="password" name="txtpassword1" id="" value="" autocomplete="off" required></td>
            </tr>
            <tr>
                <td>Password baru</td>
                <td><input type="password" name="txtpassword2" id="" value="" autocomplete="off" required></td>
            </tr>
            <tr>
                <td>Password baru</td>
                <td><input type="password" name="txtpassword3" id="" value="" autocomplete="off" required></td>
            </tr>
            <?php
            if (isset($_SESSION["s_update"])) {
                if ($_SESSION["s_update"] == "invalid old") {

                    ?>
                    <tr>
                        <td></td>
                        <td>
                            <i style="color:red;">Password lama salah!</i>
                        </td>
                    </tr>
                    <?php
                    unset($_SESSION['s_update']);
                } else if ($_SESSION["s_update"] == "invalid new") {
                    ?>
                        <tr>
                            <td></td>
                            <td>
                                <i style="color:red;">Password baru tidak sama!</i>
                            </td>
                        </tr>
                        <?php
                        unset($_SESSION['s_update']);
                } else if ($_SESSION["s_update"] == "failed") {
                    ?>
                            <tr>
                                <td></td>
                                <td>
                                    <i style="color:red;">Password gagal diubah!</i>
                                </td>
                            </tr>
                        <?php
                        unset($_SESSION['s_update']);
                } else if ($_SESSION["s_update"] == "success") {
                    ?>
                                <tr>
                                    <td></td>
                                    <td>
                                        <i style="color:green;">Password berhasil diubah!</i>
                                    </td>
                                </tr>
                        <?php
                        unset($_SESSION['s_update']);
                }
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