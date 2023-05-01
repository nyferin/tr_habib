<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$ni = $_POST["txtni"];
$role = $_POST['txtrole'];
$password1 = $_POST["txtpassword1"];
$password2 = $_POST["txtpassword2"];
$password3 = $_POST["txtpassword3"];

$dt_user = $db->selectByCode($conn->db, $role, $ni);

$dt_user = $db->selectAllById($conn->db, $role, $dt_user['id']);

$id = $dt_user['id'];

$verify_old = password_verify($password1, $dt_user['password']);

$verify_new = strcmp($password2, $password3);

session_start();

$update_password = true;
if (!$verify_old) {
    $_SESSION["s_update"] = "invalid old";
    $update_password = false;
} else if ($verify_new != 0) {
    $_SESSION["s_update"] = "invalid new";
    $update_password = false;
} else {
    $password = password_hash($password3, PASSWORD_BCRYPT, ['cost' => 9]);
    $update_password = $db->updatePassword($conn->db, $role, $id, $password);

}

if ($update_password == true) {
    $_SESSION["s_update"] = "success";
    header("Location: ../View/view-ganti-password.php");
} else {
    header("Location: ../View/view-ganti-password.php");
}