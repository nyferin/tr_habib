<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$ni = $_POST['txtni'];
$nama = $_POST['txtnama'];
$role = $_POST['txtrole'];

if ($role == "Staff") {
    $password = $_POST['txtpassword'];
} else {
    $password = password_hash($_POST['txtpassword'], PASSWORD_BCRYPT, ['cost' => 9]);
}

$insert_user = $db->createUser($conn->db, $ni, $nama, $password, $role);

if ($insert_user == true) {
    header("Location: ../View/view-data-user.php?menu={$role}");
} else {
    session_start();
    $_SESSION["s_insert"] = "failed";
    header("Location: ../View/view-insert-user.php?role={$role}");
}