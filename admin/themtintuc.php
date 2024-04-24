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
                                    <h1 class="h4 text-gray-900 mb-4">Them moi tin tuc</h1>
                                </div>
                                <form class="user" method="post" action="addnews.php" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="title" name="title"
                                            placeholder="Tieu de tin tuc">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="" id="images" name="images">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label ">Tom tat</label>
                                        <textarea class="form-control " name="summary" id="summary">

                                    </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label ">Noi dung</label>
                                        <textarea class="form-control " name="description" id="description">

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