<?php
require '../db/conn.php';

// lay dia chi id can xoa
$delid = $_GET['id'];

// Tim cac hinh anh san pham va xoa
$sql = "SELECT images FROM news WHERE id = '$delid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


// Danh sach cac anh
$img = $row['images'];
// print_r($images_arr);
// foreach ($images_arr as $img) {
    unlink($img);
// }

$sql_str = "DELETE FROM news WHERE id='$delid'";
mysqli_query($conn, $sql_str);

header('location: listnews.php');

?>