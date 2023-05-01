<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$id = $_POST['txtid'];
$ni = $_POST['txtni'];
$nama = $_POST['txtnama'];
$role = $_POST['txtrole'];

$dt_user = $db->selectAllById($conn->db, $role, $id); 

if ($_POST['txtpassword'] == "") {
    $password = $dt_user['password'];
} else {
    if ($role == "Staff") {
        $password = $_POST['txtpassword'];
    } else {
        $password = password_hash($_POST['txtpassword'], PASSWORD_BCRYPT, ['cost' => 9]);
    }
}


$update_user = $db->updateDataUser($conn->db, $ni, $nama, $password, $role, $id);

if ($update_user == true) {
    header("Location: ../View/view-data-user.php?menu={$role}");
} else {
    session_start();
    $_SESSION["s_update"] = "failed";
    header("Location: ../View/view-edit-user.php?id={$id}&role={$role}");
}
