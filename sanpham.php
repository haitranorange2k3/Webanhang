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

// Toi uu code sau
$idsp = $_GET['id'];
$sql_str = "SELECT * FROM products WHERE id = '$idsp'";
$result = mysqli_query($conn, $sql_str);
while ($row = mysqli_fetch_assoc($result)) {
    $images_arr = explode(';', $row['images']);
    ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2><?= $row['name']; ?></h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Trang chu</a>
                            <a href="./index.html">San pham</a>
                            <span><?= $row['name']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="./admin/<?= $images_arr[0]; ?>" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <?php
                            for ($i = 0; $i < count($images_arr); $i++) {
                                ?>
                                <img data-imgbigurl="./admin/<?= $images_arr[$i]; ?>" src="./admin/<?= $images_arr[$i]; ?>"
                                    alt="">
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?= $row['name']; ?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">$<?= $row['disscounted_price']; ?></div>
                        <p><?= $row['description']; ?></p>
                        <form action="" method="post">
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                        <input type="hidden" value="1" name="qty">
                                    </div>
                                    <input type="hidden" name="pid" value="<?= $idsp; ?>">
                                </div>
                            </div>
                            <button type="submit" name="atcbtn" class="btn primary-btn">ADD TO CARD</button>
                            <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        </form>
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Mo ta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Danh
                                    gia <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Thong tin san pham</h6>
                                    <p><?= $row['description']; ?></p>
                                </div>
                            </div>

                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Danh Gia</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Cac san pham lien quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $iddm = $row['category_id'];
                $sql2 = "SELECT * FROM products WHERE category_id = '$iddm' AND id <> '$idsp';";
                $result2 = mysqli_query($conn, $sql2);
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $images_arr = explode(';', $row2['images']);
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="./admin/<?= $images_arr[0]; ?>">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="sanpham.php?id=<?= $row2['id']; ?>"><?= $row2['name']; ?></a></h6>
                                <h5>$<?= $row2['disscounted_price']; ?></h5>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    <?php
}
?>
<?php
require_once './components/footer.php';
?>