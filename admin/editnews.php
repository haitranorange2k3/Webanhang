<?php

require '../db/conn.php';

$id = $_GET['id'];

$sql_str = "SELECT *, news.id as nid, news.status as nstatus, newscategories.name as dmtin FROM news, newscategories 
WHERE news.newscategory_id = newscategories.id AND news.id = '$id'";
$result = mysqli_query($conn, $sql_str);
$news = mysqli_fetch_assoc($result);

if (isset($_POST['btnUpdate'])) {
    // Lay du lieu tu form
    $title = trim($_POST['title']) ;
    $summary = trim($_POST['summary']) ;
    $description = trim($_POST['description']);
    $category = $_POST['category'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    // $images = $_POST['images'];
    
    // Xu ly hinh anh 
    // $countfiles = count($_FILES['images']['name']);

    // Co chon cac anh moi - Xoa cac anh cu di
    if (!empty($_FILES['images']['name'])) {
        // Xoa cac anh cu
        // Danh sach cac anh
        // $images_arr = explode(';', $news['images']);
        // print_r($images_arr);
        // foreach ($images_arr as $img) {
        unlink($news['images']);
        // }
    // $imgs = '';
    // for ($i=0; $i < $countfiles; $i++) { 
        $filename = $_FILES['images']['name'];
        $location = "uploads/news/" . uniqid() . $filename;
        $extension = pathinfo($location, PATHINFO_EXTENSION);
        $extension = strtolower($extension);
        
        $valid_extensions = array("jpg", "jpeg", "png");
        
        $response = 0;
        if (in_array(strtolower($extension), $valid_extensions)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'], $location)) {
                // $imgs .= $location . ";";
            }
        }
    // }
    
   // Truy van cap nhat du lieu
   $sql_str = "UPDATE `news` 
   SET 
       `title` = '$title', 
       `slug` = '$slug', 
       `description` = '$description', 
       `summary` = '$summary', 
       `images` = '$location', 
       `newscategory_id` = '$category', 
       `status` = 'Active', 
       `updated_at` = NOW() 
   WHERE `id` = '$id';";
    } else {
        $sql_str = "UPDATE `news` 
   SET 
       `title` = '$title', 
       `slug` = '$slug', 
       `description` = '$description', 
       `summary` = '$summary',
       `newscategory_id` = '$category', 
       `status` = 'Active', 
       `updated_at` = NOW() 
   WHERE `id` = '$id';";
    }

    // echo $sql_str; exit;
// echo '<pre>';
// var_dump($sql_str); exit;
// thuc hien truy van
mysqli_query($conn, $sql_str);

// tro ve trang
header('location: listnews.php');
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
                                        <h1 class="h4 text-gray-900 mb-4">Cap nhat tin tuc</h1>
                                    </div>
                                    <form class="user" method="post" action="#" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="title" name="title"
                                                placeholder="Nhap tieu de" value="<?= trim($news['title']) ; ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="file" class="" id="images" name="images" >
                                                <img src="<?=$news['images'];?>" height="100">
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="form-label text-left">Tom tat</label>
                                            <textarea class="form-control " name="summary" id="summary">
                                            <?= trim($news['summary']); ?>
                                            </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="form-label ">Noi dung</label>
                                            <textarea class="form-control text-left" name="description" id="description">
                                            <?= trim($news['description']) ?>
                                            </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="form-label ">Danh Muc: </label>
                                            <select name="category" id="category" class="form-control">
                                                <?php

                                                $sql_str = "SELECT * FROM newscategories ORDER BY name";
                                                $result = mysqli_query($conn, $sql_str);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value="<?= $row['id']; ?>"
                                                    <?php
                                                        if ($row['name'] == $news['name']) {
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