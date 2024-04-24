<?php
require 'includes/header.php';
require '../db/conn.php';
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
                                    <h1 class="h4 text-gray-900 mb-4">Them moi san pham</h1>
                                </div>
                                <form class="user" method="post" action="addproduct.php" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="name" name="name"
                                            placeholder="Nhap ten san pham">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="" id="images" name="images[]" multiple>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-4 mb-sm-0 ">
                                            <input type="text" class="form-control form-control-user" id="stock"
                                                name="stock" placeholder="So luong san pham">
                                        </div>
                                        <div class="col-sm-4 mb-sm-0 ">
                                            <input type="text" class="form-control form-control-user"
                                                id="disscounted_price" name="disscounted_price"
                                                placeholder="Gia ban san pham">
                                        </div>
                                        <div class="col-sm-4 mb-sm-0 ">
                                            <input type="text" class="form-control form-control-user" id="price"
                                                name="price" placeholder="Gia goc san pham">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label ">Mo ta</label>
                                        <textarea class="form-control " name="description" id="description">

                                    </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label ">Tom tat</label>
                                        <textarea class="form-control " name="summary" id="summary">

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
                                                <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
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
                                                <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <button class="btn btn-primary ">Them moi</button>
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
require 'includes/footer.php';
?>