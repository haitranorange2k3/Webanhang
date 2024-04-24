<?php
require '../db/conn.php';

// lay dia chi id can xoa
$delid = $_GET['id'];

$sql_str = "DELETE FROM admins WHERE id='$delid'";
mysqli_query($conn, $sql_str);

header('location: listuser.php');

?>