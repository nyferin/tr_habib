<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] != "Staff") {
    header("Location: index.php");
}

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();


$db_guru = $db->selectDataUser($conn->db, "Guru");
$db_kelas = $db->selectJoinKodeKelas($conn->db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Jadwal | Staff
    </title>
</head>

<body>
    <h1>
        Insert Jadwal
    </h1>
    <a href="view-data-jadwal.php?menu=Kelas">Back</a>

    <form action="../Controller/controller-insert-jadwal.php" method="post">
        <table>
            <tr>
                <td>Kode Kelas</td>
                <td>
                    <input type="text" name="txtkelas" id="" list="kelas" autocomplete="off" required>
                    <datalist id="kelas">
                        <?php
                        foreach ($db_kelas as $key) {
                            ?>
                            <option value="<?= $key['kode_kelas'] ?>">
                                <?= $key['kode_kelas'] . "-" . $key['mapel'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </datalist>
                </td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>
                    <input type="text" name="txtguru" id="" list="guru" autocomplete="off" required>
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
            <tr>
                <td>Hari-1</td>
                <td>
                    <input type="text" name="txthari1" id="" list="hari" autocomplete="off" required>
                    <datalist id="hari">
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </datalist>
                </td>
                <td>Hari-2</td>
                <td>
                    <input type="text" name="txthari2" id="" list="hari" value="" autocomplete="off">
                    <datalist id="hari">
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </datalist>
                </td>
                <td>Hari-3</td>
                <td>
                    <input type="text" name="txthari3" id="" list="hari" value="" autocomplete="off">
                    <datalist id="hari">
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </datalist>
                </td>
            </tr>
            <tr>
                <td>Jam-1</td>
                <td>
                    <input type="time" name="txtjam1_1" id="" autocomplete="off" required> s.d. <input type="time" name="txtjam1_2" id="" autocomplete="off" required>
                </td>
                <td>Jam-2</td>
                <td>
                    <input type="time" name="txtjam2_1" id="" autocomplete="off"> s.d. <input type="time" name="txtjam2_2" id="" autocomplete="off">
                </td>
                <td>Jam-3</td>
                <td>
                    <input type="time" name="txtjam3_1" id="" autocomplete="off"> s.d. <input type="time" name="txtjam3_2" id="" autocomplete="off">
                </td>
            </tr>
            <?php
            if (isset($_SESSION["s_insert"]) and $_SESSION["s_insert"] == "failed") {
                ?>
                <tr>
                    <td></td>
                    <td>
                        <i style="color:red;">Jadwal baru gagal ditambahkan!</i>
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