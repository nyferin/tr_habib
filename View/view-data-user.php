<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] != "Staff") {
    header("Location: index.php");
}

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$menu = $_GET['menu'];

$db_dt = $db->selectAllData($conn->db, $menu);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data
        <?= $menu ?> | Staff
    </title>

    <style>
        table,
        tr,
        td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h1>
        Data
        <?= $menu ?>
    </h1>
    <a href="view-home-staff.php">Back</a>

    <table>
        <tr>
            <?php
            if ($menu == "Siswa") {
                ?>
                <th>NIS</th>
                <?php
            } else {
                ?>
                <th>NIP</th>
                <?php
            }

            ?>
            <th>Nama</th>
            <th>Password</th>
            <th>Role</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        if (count($db_dt) == 0) {
            ?>
            <tr>
                <td colspan="5">
                    <i>No record.</i>
                </td>
            </tr>
            <?php
        } else {
            foreach ($db_dt as $key) {
                ?>
                <tr>
                    <?php
                    if ($menu == "Siswa") {
                        ?>
                        <td>
                            <?= "" . $key['nis'] ?>
                        </td>
                        <?php
                    } else {
                        ?>
                        <td>
                            <?= "" . $key['nip'] ?>
                        </td>
                        <?php
                    }
                    ?>
                    <td>
                        <?= "" . $key['nama'] ?>
                    </td>
                    <td>
                        <?= "" . $key['password'] ?>
                    </td>
                    <td>
                        <?= "" . $key['role'] ?>
                    </td>
                    <td>
                        <a href="view-edit-user.php?id=<?= $key['id'] ?>&role=<?= $menu ?>">
                            <button>edit</button>
                        </a>
                    </td>
                    <td>
                        <a href="../Controller/controller-delete.php?id=<?= $key['id'] ?>&role=<?= $menu ?>">
                            <button>delete</button>
                        </a>
                    </td>
                </tr>
                <?php
            }
        }

        ?>
    </table>
    <?php
    if (isset($_SESSION["s_delete"]) and $_SESSION["s_delete"] == "failed") {
        ?>
        <tr>
            <td></td>
            <td>
                <i style="color:red;">Delete gagal!</i>
            </td>
        </tr>
        <?php
        unset($_SESSION['s_delete']);
    }
    ?>
    <a href="view-insert-user.php?role=<?= $menu ?>">
        <button>add</button>
    </a>
</body>

</html>