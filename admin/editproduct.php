<?php

require '../db/conn.php';

$id = $_GET['id'];

$sql_str = "SELECT products.id as id, summary, price, stock, description,disscounted_price,
            products.name as pname, images, categories.name as cname, brands.name as bname, products.status as pstatus
            FROM products, categories, brands WHERE products.category_id=categories.id and products.brand_id = brands.id
            AND products.id='$id'";
$result = mysqli_query($conn, $sql_str);
$prd = mysqli_fetch_assoc($result);

if (isset($_POST['btnUpdate'])) {
    // Lay du lieu tu form
    $name = $_POST['name'];
    $summary = $_POST['summary'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $disscounted_price = $_POST['disscounted_price'];
    $stock = $_POST['stock'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    // $images = $_POST['images'];
    
    // Xu ly hinh anh 
    $countfiles = count($_FILES['images']['name']);

    // Co chon cac anh moi - Xoa cac anh cu di
    if (!empty($_FILES['images']['name'][0])) {
        // Xoa cac anh cu
        // Danh sach cac anh
        $images_arr = explode(';', $prd['images']);
        // print_r($images_arr);
        foreach ($images_arr as $img) {
            unlink($img);
        }
    } 

    $imgs = '';
    for ($i=0; $i < $countfiles; $i++) { 
        $filename = $_FILES['images']['name'][$i];
        $location = "uploads/". uniqid().$filename;
        $extension = pathinfo($location, PATHINFO_EXTENSION);
        $extension = strtolower($extension);
    
        $valid_extensions = array("jpg", "jpeg", "png");
    
        $response = 0;
        if (in_array(strtolower($extension), $valid_extensions)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'][$i],$location)) {
                $imgs .= $location . ";";
            }
        }
    }
    
    $imgs = substr($imgs, 0, -1);
    // echo $imgs;
    // Truy van them du lieu
    $sql_str1 = "UPDATE `products` SET 
            `name` = '$name',
            `slug` = '$slug',
            `description` = '$description',
            `summary` = '$summary',
            `stock` = '$stock',
            `price` = '$price',
            `disscounted_price` = '$disscounted_price',
            `images` = '$imgs',
            `category_id` = '$category',
            `brand_id` = '$brand',
            `status` = 'Active',
            `updated_at` = NOW()
            WHERE `id` = '$id';";
    
    echo $sql_str1;
    // thuc hien truy van
    mysqli_query($conn, $sql_str1);
    header("location: listsanpham.php");
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
                                        <h1 class="h4 text-gray-900 mb-4">Cap nhat san pham</h1>
                                    </div>
                                    <form class="user" method="post" action="#" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="name" name="name"
                                                placeholder="Nhap ten san pham" value="<?= $prd['pname']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="file" class="" id="images" name="images[]" multiple>
                                                <?php $arr = explode(';', $prd['images']);
                                                foreach ($arr as $img) {
                                                    echo "<img src='$arr[0]' height=100px>";                                             
                                                }
                                                ?>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4 mb-sm-0 ">
                                                <input type="text" class="form-control form-control-user" id="stock"
                                                    name="stock" placeholder="So luong san pham"
                                                    value="<?= $prd['stock']; ?>">
                                            </div>
                                            <div class="col-sm-4 mb-sm-0 ">
                                                <input type="text" class="form-control form-control-user"
                                                    id="disscounted_price" name="disscounted_price"
                                                    placeholder="Gia ban san pham"
                                                    value="<?= $prd['disscounted_price']; ?>">
                                            </div>
                                            <div class="col-sm-4 mb-sm-0 ">
                                                <input type="text" class="form-control form-control-user" id="price"
                                                    name="price" placeholder="Gia goc san pham"
                                                    value="<?= $prd['price']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label ">Mo ta</label>
                                            <textarea class="form-control text-left" name="description" id="description">
                                            <?= $prd['description']; ?>
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label text-left">Tom tat</label>
                                            <textarea class="form-control " name="summary" id="summary">
                                            <?= $prd['summary']; ?>
                                            </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="form-label ">Thuong hieu: </label>
                                            <select name="brand" id="brand" class="form-control">
                                                <?php

                                                $sql_str = "SELECT * FROM brands ORDER BY name";
                                                $result = mysqli_query($conn, $sql_str);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value="<?= $row['id']; ?>"
                                                    <?php
                                                        if ($row['name'] == $prd['bname']) {
                                                            echo "selected";
                                                        }
                                                    ?>
                                                    >
                                                    
                                                    <?= $row['name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label ">Danh Muc: </label>
                                            <select name="category" id="category" class="form-control">
                                                <?php

                                                $sql_str = "SELECT * FROM categories ORDER BY name";
                                                $result = mysqli_query($conn, $sql_str);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value="<?= $row['id']; ?>"
                                                    <?php
                                                        if ($row['name'] == $prd['cname']) {
                                                            echo "selected";
                                                        }
                                                    ?>
                                                    >
                                                    
                                                    <?= $row['name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <button class="btn btn-primary " name="btnUpdate">Cap Nhat</button>
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