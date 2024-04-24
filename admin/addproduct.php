<?php
require '../db/conn.php';

//Lay du lieu tu form
$name = $_POST['name'];
$summary = $_POST['summary'];
$description = $_POST['description'];
$price = $_POST['price'];
$brand = $_POST['brand'];
$category = $_POST['category'];
$disscounted_price = $_POST['disscounted_price'];
$stock = $_POST['stock'];
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
// $images = $_POST['images'];

// Xu ly hinh anh 
$countfiles = count($_FILES['images']['name']);
$imgs = '';
for ($i=0; $i < $countfiles; $i++) { 
    $filename = $_FILES['images']['name'][$i];
    $location = "uploads/". uniqid().$filename;
    $extension = pathinfo($location, PATHINFO_EXTENSION);
    $extension = strtolower($extension);

    $valid_extensions = array("jpg", "jpeg", "png");

    $response = 0;
    if (in_array(strtolower($extension), $valid_extensions)) {
        if (move_uploaded_file($_FILES['images']['tmp_name'][$i],$location)) {
            $imgs .= $location . ";";
        }
    }
}

$imgs = substr($imgs, 0, -1);
// echo $imgs;
// Truy van them du lieu
$sql_str = "INSERT INTO `products` (`id`, `name`, `slug`, `description`, `summary`, `stock`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES (NULL, '$name', '$slug', '$description', '$summary', '$stock', '$price', '$disscounted_price', '$imgs', '$category', '$brand', 'Active', NOW(), NULL);";

// echo $sql_str; exit;
// thuc hien truy van
mysqli_query($conn, $sql_str);

// tro ve trang
header('location: listsanpham.php');
?>