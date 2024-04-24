<?php
require '../db/conn.php';

//Lay du lieu tu form
$name = $_POST['name'];
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

// echo $imgs;
// Truy van them du lieu
$sql_str = "INSERT INTO `categories` (`name`, `slug`,`status` ) VALUES ('$name', '$slug','Active')";

// echo $sql_str; exit;
// thuc hien truy van
mysqli_query($conn, $sql_str);

// tro ve trang
header('location: listcarts.php');
?>