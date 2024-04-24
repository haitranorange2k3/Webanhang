<?php
require '../db/conn.php';

// lay dia chi id can xoa
$delid = $_GET['id'];

// Tim cac hinh anh san pham va xoa
$sql = "SELECT images FROM products WHERE id = '$delid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


// Danh sach cac anh
$images_arr = explode(';', $row['images']);
// print_r($images_arr);
foreach ($images_arr as $img) {
    unlink($img);
}

$sql_str = "DELETE FROM products WHERE id='$delid'";
mysqli_query($conn, $sql_str);

header('location: listsanpham.php');

?>