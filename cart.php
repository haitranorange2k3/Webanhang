<?php
session_start(); 
$is_homepage = false;

require './db/conn.php';
// Kiem tra nut them vao gio hang duoc an
if (isset($_POST['atcbtn'])) {
    $id = $_POST['pid'];
    $qty = $_POST['qty'];
    // Them san pham vao gio hang
    
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    $isFound = false;
    for ($i=0; $i < count($cart); $i++) { 
        if ($cart[$i]['id'] == $id) {
            $cart[$i]['qty'] += $qty;
            $isFound = true;
            break;
        }
    }
    if (!$isFound) {
        $sql_str = "SELECT * FROM products WHERE id = '$id'";
        // echo $sql_str;
        $result = mysqli_query($conn, $sql_str);
        $product = mysqli_fetch_assoc($result);
        $product['qty'] = $qty;
        $cart[] = $product;
    }
    // print_r($sql_str);
    // Update Session
    $_SESSION['cart'] = $cart;
    // thu in ra $cart o sesssion 
    // echo '<pre>';
    // var_dump($cart); 
    // exit;
}
require './components/header.php';
?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Gio hang</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Gio hang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Hoa Don Chi tiet</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="checkout__order">
                                <h4>Gio hang</h4>
                                <div class="checkout__order__products">Products</div>
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>Num</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $cart = [];
                                    if (isset($_SESSION['cart'])) {
                                        $cart = $_SESSION['cart'];
                                    }
                                    echo '<pre>';
                                    $count = 1;
                                    $total = 0;
                                    foreach ($cart as $item) {
                                        $subtotal = $item['qty'] * $item['disscounted_price'];
                                        $total += $subtotal;
                                    ?>
                                        <form action="updatecart.php?id=<?=$item['id'];?>" method="post">
                                            <tr>
                                                <td><?=$count++;?></td>
                                                <td><?=$item['name'];?></td>
                                                <td><span>$<?=$item['disscounted_price'];?></span></td>
                                                <td class="shoping__cart__quantity">
                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <!-- Thêm input ẩn để truyền qty cho sản phẩm -->
                                                            <input type="text" name="new_qty" value="<?=$item['qty'];?>">
                                                            <input type="hidden" name="qty" value="<?=$item['qty'];?>">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>$<?=number_format($subtotal, 0, '', '.');?></td>
                                                <td>
                                                    <a href="deletecart.php?id=<?=$item['id'];?>" class="btn btn-danger">Delete</a>
                                                    <button name="upbtn" class="btn btn-warning w-auto mt-0">Update</button>
                                                </td>
                                            </tr>
                                        </form>
                                    <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>                             
                                <div class="checkout__order__total">Total <span>$<?=number_format($total, 0, '', '.');?></span></div>
                                <div class="d-flex justify-content-between align-items-center ">
                                    <a href="shop.php" class="btn btn-primary ">Continue Buy</a>
                                    <a href="thanhtoan.php" class="btn btn-success w-25 ">Place Order</a>
                                    <!-- <button type="submit" class="btn btn-success d-inline-block w-25">PLACE ORDER</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

<?php
require './components/footer.php';
?>