<?php
require 'includes/header.php';
require '../db/conn.php';
// Kiem tra quyen 
// print_r($_SESSION['user']); exit();
if ($_SESSION['user']['type'] != 'Admin') {
    echo '<div class="alert alert-danger ">Ban khong the truy cap trang nay !!</div>';
    // exit();
} else {
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
                                    <h1 class="h4 text-gray-900 mb-4">Them moi Tai khoan</h1>
                                </div>
                                <form class="user" method="post" action="adduser.php">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="name" name="name"
                                            placeholder="Ten Tai khoan (quan tri)">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email"
                                            placeholder="Nhap Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="password" name="password"
                                            placeholder="Nhap password">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="phone" name="phone"
                                            placeholder="Nhap so dien thoai">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="address" name="address"
                                            placeholder="Nhap dia chi">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label ">Phan quyen : </label>
                                        <select name="type" id="category" class="form-control">
                                            <option value="Admin">Admin</option>
                                            <option value="Staff">Staff</option>
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
}
require 'includes/footer.php';
?>