<?php

require '../db/conn.php';

$id = $_GET['id'];

$sql_str = "SELECT * FROM admins WHERE id = '$id'";
$result = mysqli_query($conn, $sql_str);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['btnUpdate'])) {
    // Lay du lieu tu form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $type = $_POST['type'];


    // Truy van cap nhat du lieu
    $sql_str = "UPDATE `admins` 
    SET 
        `name` = '$name', 
        `email` = '$email', 
        `password` = '$password', 
        `phone` = '$phone', 
        `type` = '$type', 
        `updated_at` = NOW() 
    WHERE `id` = '$id';";
    mysqli_query($conn, $sql_str);

    // tro ve trang
    header('location: listuser.php');
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
                                        <h1 class="h4 text-gray-900 mb-4">Cap nhat Tai khoan</h1>
                                    </div>
                                    <form class="user" method="post" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="name" name="name" value="<?= $row['name']; ?>" placeholder="Ten Tai khoan (quan tri)">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= $row['email']; ?>" placeholder="Nhap Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="password" name="password" value="<?= $row['password']; ?>" placeholder="Nhap password">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="phone" name="phone" value="<?= $row['phone']; ?>" placeholder="Nhap so dien thoai">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="address" name="address" value="<?= $row['address']; ?>" placeholder="Nhap dia chi">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label ">Phan quyen : </label>
                                            <select name="type" id="category" class="form-control">
                                                <option value="Admin" <?php
                                                                        if ($row['type'] == 'Admin') {
                                                                            echo "selected";
                                                                        }
                                                                        ?>>Admin</option>
                                                <option value="Staff" <?php
                                                                        if ($row['type'] == 'Staff') {
                                                                            echo "selected";
                                                                        }
                                                                        ?>>Staff</option>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary " name="btnUpdate">Them moi</button>
                                    </form>

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