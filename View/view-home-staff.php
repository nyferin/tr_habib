<?php

session_start();
if (!isset($_SESSION["s_user"]) or $_SESSION["s_user"] == "invalid" or $_SESSION["s_role"] != "Staff") {
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
    <title>Dashboard | Staff</title>
</head>

<body>
    <h1>
        Hello
        <?= "{$_SESSION['s_user']}" ?>!
    </h1>
    <a href="../Controller/controller-logout.php">Logout</a>
    <ul>
        <li>
            <a href="view-data-user.php?menu=Staff">Staff 
                (<?=
                    count($db->selectAllData($conn->db, "Staff"))
                    ?>)
            </a>
        </li>
        <li>
            <a href="view-data-user.php?menu=Guru">Guru 
                (<?=
                    count($db->selectAllData($conn->db, "Guru"))
                    ?>)
            </a>
        </li>
        <li>
            <a href="view-data-user.php?menu=Siswa">Siswa 
                (<?=
                    count($db->selectAllData($conn->db, "Siswa"))
                    ?>)
            </a>
        </li>
        <li>
            <a href="view-data-mapel.php?menu=Mapel">Mata Pelajaran 
                (<?=
                    count($db->selectAllData($conn->db, "Mapel"))
                    ?>)
            </a>
        </li>
        <li>
            <a href="view-data-kodekelas.php?menu=KodeKelas">Kode Kelas 
                (<?=
                    count($db->selectAllData($conn->db, "KodeKelas"))
                    ?>)
            </a>
        </li>
        <li>
            <a href="view-data-jadwal.php?menu=Jadwal">Jadwal 
                (<?=
                    count($db->selectJoinJadwalUnique($conn->db))

                    ?>)
            </a>
        </li>
    </ul>
</body>

</html>