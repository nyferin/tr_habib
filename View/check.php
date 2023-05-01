<?php

include("../Model/class-connect-db.php");
include("../Model/class-db.php");

$conn = new Connection();
$db = new DatabaseFunction();

$check_kodekelas = $db->selectByCode($conn->db, "KodeKelas", "A");

if ($check_kodekelas == false) {
    $check_kodekelas = "true";
}

echo "<pre>";
echo print_r(gettype($check_kodekelas));
echo "<br>";
echo print_r($check_kodekelas);
echo "<pre>";
?>