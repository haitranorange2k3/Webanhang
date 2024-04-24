<?php

require '../db/conn.php';

$id = $_GET['id'];

$sql_str = "SELECT * FROM orders WHERE id = '$id'";
$result = mysqli_query($conn, $sql_str);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['btnUpdate'])) {

    $status = $_POST['status'] ;
    // echo $status;
    
    // Truy van cap nhat du lieu
    $sql_str = "UPDATE `orders` 
    SET 
        `status` = '$status'
    WHERE `id` = '$id';";
    // echo $sql_str; exit;
    mysqli_query($conn, $sql_str);
    // tro ve trang
    header('location: listorder.php');
} else {
    require 'includes/header.php'; 
    ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Cap nhat Don hang</h1>
                                    </div>
                                    <form class="user" method="post" action="#">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Full Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?=$row['firsrname'] . ' '. $row['lastname'];?></p>
                                            </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?=$row['email'];?></p>
                                            </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Phone</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?=$row['phone'];?></p>
                                            </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Address</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?=$row['address'];?></p>
                                            </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-sm-12 ">
                                                    <!-- <select class="form-control" name="status">
                                                        <option value="<?=$row['status'] == 'Processing' ? 'selected' : ' ';?>">Processing</option>
                                                        <option value="<?=$row['status'] == 'Confirmed' ? 'selected' : ' ';?>">Confirmed</option>
                                                        <option value="<?=$row['status'] == 'Shipping' ? 'selected' : ' ';?>">Shipping</option>
                                                        <option value="<?=$row['status'] == 'Delivered' ? 'selected' : ' ';?>">Delivered</option>
                                                        <option value="<?=$row['status'] == 'Cancelled' ? 'selected' : ' ';?>">Cancelled</option>
                                                    </select> -->
                                                    <select class="form-control" name="status">
                                                        <option value="Processing" <?= $row['status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                                                        <option value="Confirmed" <?= $row['status'] == 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                                        <option value="Shipping" <?= $row['status'] == 'Shipping' ? 'selected' : '' ?>>Shipping</option>
                                                        <option value="Delivered" <?= $row['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                                        <option value="Cancelled" <?= $row['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary w-25 mt-5" name="btnUpdate">Cap Nhat</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    <div class="">
                                        <h3 class="text-gray-900 mb-4">Chi tiet don hang</h3>
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th>#Num</th>
                                                    <th>Products Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                        <?php
                                        $sql = "SELECT *, products.name as pname, order_details.price as oprice
                                          FROM products, order_details WHERE products.id = order_details.product_id 
                                        AND order_id = '$id'";
                                        $result = mysqli_query($conn, $sql);
                                        $i = 1;
                                        $sumTotal = 0;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $sumTotal += $row['oprice'] * $row['qty'];
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$row['pname'];?></td>
                                                <td><?=$row['oprice'];?></td>
                                                <td><?=$row['qty'];?></td>
                                                <td>$<?=$row['total'];?></td>
                                            </tr>
                                        </tbody>
                                        <?php
                                        }
                                        ?>
    
                                        </table>
                                        <div class="bg-dark rounded-pill text-center text-white  fw-bold ">
                                            <h3>Total Sum = <span class="">$<?=$sumTotal;?></span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php
}
require 'includes/footer.php';
?>