<?php
require '../db/conn.php';

// lay dia chi id can xoa
$delid = $_GET['id'];

$sql_str = "DELETE FROM categories WHERE id='$delid'";
mysqli_query($conn, $sql_str);

header('location: listcarts.php');

?>