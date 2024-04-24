<?php
session_start();
$idsp = $_GET['id'];
$new_qty = $_POST['new_qty']; // Lấy giá trị qty mới

$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}

for ($i=0; $i < count($cart); $i++) { 
    if ($cart[$i]['id'] == $idsp) {
        $cart[$i]['qty'] = $new_qty; // Cập nhật qty mới
        break;
    }
}

// Update session
$_SESSION['cart'] = $cart;

header('location: cart.php');   
?>
