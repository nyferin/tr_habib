<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$ni = $_POST["txtni"];
$password = $_POST["txtpassword"];

$db_users = $db->selectAllUser($conn->db);

session_start();

for ($i = 0; $i < count($db_users); $i++) {
    if ($db_users[$i]['ni'] == $ni and $db_users[$i]['password'] == $password or 
    $db_users[$i]['ni'] == $ni and password_verify($password, $db_users[$i]['password'])) {
        $_SESSION["s_ni"] = $db_users[$i]['ni'];
        $_SESSION["s_user"] = $db_users[$i]['nama'];
        $_SESSION["s_role"] = $db_users[$i]['role'];
        header("Location: controller-session.php");
        break;

    } else {
        $_SESSION["s_user"] = "invalid";
        header("Location: ../View/index.php");

    }
}
