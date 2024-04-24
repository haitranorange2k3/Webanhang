<?php
require '../db/conn.php';

//Lay du lieu tu form
$title = $_POST['title'];
$summary = $_POST['summary'];
$description = $_POST['description'];
$category = $_POST['category'];
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
// $images = $_POST['images'];

// Xu ly hinh anh 
// $countfiles = count($_FILES['images']['name']);
// $imgs = '';
// for ($i=0; $i < $countfiles; $i++) { 
$filename = $_FILES['images']['name'];
$location = "uploads/news/" . uniqid() . $filename;
$extension = pathinfo($location, PATHINFO_EXTENSION);
$extension = strtolower($extension);

$valid_extensions = array("jpg", "jpeg", "png");

$response = 0;
if (in_array(strtolower($extension), $valid_extensions)) {
    if (move_uploaded_file($_FILES['images']['tmp_name'], $location)) {
        // $imgs .= $location . ";";
    }
}
// }

// $imgs = substr($imgs, 0, -1);
// echo $imgs;
// Truy van them du lieu
$sql_str = "INSERT INTO `news` (`id`, `title`, `slug`, `description`, `summary`, `images`, `newscategory_id`, `status`, `created_at`, `updated_at`) 
VALUES (NULL, '$title', '$slug', '$description', '$summary', '$location', '$category', 'Active', NOW(), NOW());";

// echo $sql_str; exit;
// thuc hien truy van
mysqli_query($conn, $sql_str);

// tro ve trang
header('location: listnews.php');
?>