<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] != "Staff") {
    header("Location: index.php");
}

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$dt_mapel = $db->selectAllData($conn->db, "Mapel");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Kode Kelas | Staff
    </title>
</head>

<body>
    <h1>
        Data Kode Kelas
    </h1>
    <a href="view-data-kodekelas.php?menu=KodeKelas">Back</a>

    <form action="../Controller/controller-insert-kodekelas.php" method="post">
        <table>
            <tr>
                <td>Kode Kelas</td>
                <td>
                    <input type="text" name="txtkelas" id="" autocomplete="off" required>
                    </datalist>
                </td>
            </tr>
            <tr>
                <td>Kode Mapel</td>
                <td>
                    <input type="text" name="txtmapel" id="" list="mapel" autocomplete="off" required>
                    <datalist id="mapel">
                        <?php
                        foreach ($dt_mapel as $key) {
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
            if (isset($_SESSION["s_insert"]) and $_SESSION["s_insert"] == "failed") {
                ?>
                <tr>
                    <td></td>
                    <td>
                        <i style="color:red;">Kelas baru gagal ditambahkan!</i>
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