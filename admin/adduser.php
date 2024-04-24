<?php
require '../db/conn.php';

//Lay du lieu tu form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$type = $_POST['type'];
$remember_token = bin2hex(random_bytes(25));

// echo $imgs;
// Truy van them du lieu
$sql_str = "INSERT INTO `admins` (`name`, `email`, `password`, `remember_token` , `email_verified_at`, `phone`,`address`,`type`,`status`,`created_at`,`updated_at`)
VALUES ('$name', '$email', '$password', '$remember_token', NOW(), '$phone', '$address', '$type','Active', NOW(), NOW())";

// echo $sql_str; exit;
// thuc hien truy van
mysqli_query($conn, $sql_str);

// tro ve trang
header('location: listuser.php');
?>