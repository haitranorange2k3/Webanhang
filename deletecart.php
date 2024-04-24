<?php
session_start();
$idsp = $_GET['id'];

$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}

for ($i=0; $i < count($cart); $i++) { 
    if ($cart[$i]['id'] == $idsp) {
        // Xóa phần tử tại vị trí $i
        unset($cart[$i]);
        // Đặt lại chỉ số của mảng
        $cart = array_values($cart);
        break;
    }
}

// Update session
$_SESSION['cart'] = $cart;

header('location: cart.php');   
?>
