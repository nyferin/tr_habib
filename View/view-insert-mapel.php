<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] != "Staff") {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data Mata Pelajaran | Staff
    </title>
</head>

<body>
    <h1>
        Data Mata Pelajaran
    </h1>
    <a href="view-data-mapel.php?menu=Mapel">Back</a>

    <form action="../Controller/controller-insert-mapel.php" method="post">
        <table>
            <tr>
                <td>Kode</td>
                <td><input type="text" name="txtkode" id="" autocomplete="off" required></td>
            </tr>
            <tr>
                <td>Mata Pelajaran</td>
                <td><input type="text" name="txtmapel" id="" autocomplete="off" required></td>
            </tr>
            <?php
            if (isset($_SESSION["s_insert"]) and $_SESSION["s_insert"] == "failed") {
                ?>
                <tr>
                    <td></td>
                    <td>
                        <i style="color:red;">Mapel baru gagal ditambahkan!</i>
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