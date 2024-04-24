<?php
session_start();
$errMsg = null;
if (isset($_POST['btnSubmit'])) {
    // lay data tu form
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Ket noi CSDL
    require_once '../db/conn.php';
    // Cau lenh truy van
    $sql = "SELECT * FROM admins WHERE email = '$email' AND password='$password'";
    // Thuc thi cau lenh
    $result = mysqli_query($conn, $sql);
    // Kiem tra so luong record tra ve : > 0 : dang nhap thanh cong
    if (mysqli_num_rows($result) > 0) {
        // echo "Login !!";
        // Luu tru thong tin dang nhap
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row;
        // echo '<pre>';
        // print_r($_SESSION['user']);
        // Chuyen qua trang quan tri
        header('location: index.php');
    } else {
        $errMsg = '<div class="alert alert-danger ">
        Dang nhap khong thanh cong, kiem tra lai tai khoan dang nhap !
        </div>';
        require_once 'includes/loginform.php';
    }
} else {
    require_once 'includes/loginform.php';
} ?>