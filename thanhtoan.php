<?php
session_start(); 
$is_homepage = false;
require_once './db/conn.php';
$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
$alert = '';

if (isset($_POST['btnDathang'])) {
    // Lay thong tin KH tu form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    // Tao data cho order

    $sql1 = "INSERT INTO orders VALUES (0, 0, '$firstname', '$lastname', '$address', '$phone', '$email', 'Processing', NOW(), NOW());";
    // echo $sql1; exit;
    // mysqli_query($conn, $sql1);
    // Lay id vua duoc them vao
    if (mysqli_query($conn, $sql1)) {
        $last_order_id = mysqli_insert_id($conn);
        // Sau do them vao order detail
        foreach ($cart as $item) {
            $masp = $item['id'];
            $disscounted_price = $item['disscounted_price'];
            $qty = $item['qty'];
            $total = $item['qty'] * $item['disscounted_price'];
            $sql2 = "INSERT INTO order_details VALUES (0, '$last_order_id', '$masp', '$disscounted_price', '$qty', '$total', NOW(), NOW())";
            mysqli_query($conn, $sql2);
        }
    }
    // Xoa cart khi da thanh toan
    unset($_SESSION["cart"]);
    // header('location: thankyou.php');
    $alert = '<div class="alert alert-success fw-bold " role="alert">
                Ban da dat hang thanh cong ! <br> Hay cho doi thong tin lien lac tu shop cua chung toi ! <br> Xin chan thanh cam on !
            </div>';
}




require_once './components/header.php';
?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Don hang</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Don hang</span>
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
                    <?=$alert;?>
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Chi tiet don dat hang</h4>
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="firstname">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="lastname">
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" name="address">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    <?php
                                    $cart = [];
                                    if (isset($_SESSION['cart'])) {
                                        $cart = $_SESSION['cart'];
                                    }
                                    // echo '<pre>';
                                    // $count = 1;
                                    $total = 0;
                                    $subtotal = 0;
                                    foreach ($cart as $item) {
                                        $subtotal = $item['qty'] * $item['disscounted_price'];
                                        $total += $subtotal;
                                    ?>
                                    <li><?=$item['name'];?> <span>$<?=$item['disscounted_price'];?></span></li>
                                    <?php } ?>
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>$<?=$subtotal;?></span></div>
                                <div class="checkout__order__total">Total <span>$<?=$total;?></span></div>
                                <button type="submit" class="site-btn" name="btnDathang">PLACE ORDER</button>
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