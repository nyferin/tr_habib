<?php

session_start();

if ($_SESSION["s_role"] == "Staff") {
    header("Location: ../View/view-home-staff.php");

} else if ($_SESSION["s_role"] == "Guru") {
    header("Location: ../View/view-home-guru.php");

} else if ($_SESSION["s_role"] == "Siswa") {
    header("Location: ../View/view-home-siswa.php");

}