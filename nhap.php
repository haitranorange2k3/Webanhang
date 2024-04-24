<?php
require './db/conn.php';
session_start(); 
$cart = [];
                    if (isset($_SESSION['cart'])) {
                        $cart = $_SESSION['cart'];
                    }
                    $count = 0;
                    foreach ($cart as $item) {
                        $count += $item['qty'];
                    }
                    // echo $count;
                    print($count);