<?php

require '../db/conn.php';

$id = $_GET['id'];

$sql_str = "SELECT * FROM newscategories WHERE id = '$id'";
$result = mysqli_query($conn, $sql_str);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['btnUpdate'])) {
   // Neu nut cap nhat duoc bat
   $name = $_POST['name'];
   $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

   // Thuc hien viec cap nhat
   $query = "UPDATE newscategories SET name = '$name', slug = '$slug' WHERE id = '$id'";
   mysqli_query($conn, $query);

    // Chuyen ve trang listbrands
    header("location: listnewscats.php");
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
                                    <h1 class="h4 text-gray-900 mb-4">Cap nhat danh muc tin tuc</h1>
                                </div>
                                <form class="user" method="post" action="#">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="name" name="name"
                                            placeholder="Nhap ten danh muc" value="<?=$row['name'];?>">
                                    </div>

                                    <button class="btn btn-primary " name="btnUpdate">Cap nhat</button>
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