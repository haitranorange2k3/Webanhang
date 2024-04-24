<?php
session_start();
// Xoa sesssion_user
unset($_SESSION['user']);
header("location: login.php");
?>