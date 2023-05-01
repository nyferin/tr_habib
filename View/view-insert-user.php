<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] != "Staff") {
    header("Location: index.php");
}

$role = $_GET['role'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data <?= $role ?> | Staff</title>
</head>

<body>
    <h1>
        Data <?= $role ?>
    </h1>
    <a href="view-data-user.php?menu=<?= $role ?>">Back</a>

    <form action="../Controller/controller-insert-user.php" method="post">
        <table>
        <input type="text" name="txtrole" id="" value="<?= $role ?>" hidden readonly>
            <tr>
        <?php
            if ($role == "Siswa") {
                ?>
                <td>NIS</td>
                <?php
            } else {
                ?>
                <td>NIP</td>
                <?php
            }
            
            ?>
                <td><input type="text" name="txtni" id="" autocomplete="off" required></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="txtnama" id="" autocomplete="off" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="text" name="txtpassword" id="" autocomplete="off" required></td>
            </tr>
            <?php
            if (isset($_SESSION["s_insert"]) and $_SESSION["s_insert"] == "failed") {
                ?>
                <tr>
                    <td></td>
                    <td>
                        <i style="color:red;">User baru gagal ditambahkan!</i>
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