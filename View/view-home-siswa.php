<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] != "Siswa") {
    header("Location: index.php");
}

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Siswa</title>
</head>

<body>
    <h1>
        Hello
        <?= "{$_SESSION['s_user']}" ?>!
    </h1>
    <a href="../Controller/controller-logout.php">Logout</a>
    <ul>
        <li>
            <a href="view-data-jadwal-siswa.php">Jadwal Belajar
                (<?=
                    count($db->selectJoinJadwalUnique($conn->db))

                    ?>)
            </a>
        </li>
        <li>
            <a href="view-ganti-password.php">Ganti Password
            </a>
        </li>
    </ul>
</body>

</html>