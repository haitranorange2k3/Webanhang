<?php
session_start(); 
$is_homepage = false;
require './components/header.php';
?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Blog</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Danh muc tin</h4>
                            <ul>
                                <li><a href="#">All</a></li>
                                <?php
                                $query = "SELECT * FROM newscategories ORDER BY id LIMIT 5";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <li><a href="#"><?=$row['name'];?> (10)</a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Tin moi</h4>
                            <div class="blog__sidebar__recent">
                                <?php
                                $query2 = "SELECT * FROM news ORDER BY created_at DESC LIMIT 3";
                                $result2 = mysqli_query($conn,$query2);
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                ?>
                                <a href="tintuc.php?id=<?= $row2['id']; ?>" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="./admin/<?= $row2['images']; ?>" height="70">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6><?= $row2['title']; ?></h6>
                                        <span><?= $row2['created_at']; ?></span>
                                    </div>
                                </a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Tim kiem</h4>
                            <div class="blog__sidebar__item__tags">
                                <?php
                                $query = "SELECT * FROM categories ORDER BY RAND() LIMIT 6";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <a href="#"><?= $row['name']; ?></a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        <?php
                        $query = "SELECT * FROM news ORDER BY RAND()";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="./admin/<?= $row['images']; ?>" height=200 width="160" style="object-fit: cover;">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> <?= $row['created_at']; ?></li>
                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                    </ul>
                                    <h5><a href="tintuc.php?id=<?= $row['id']; ?>"><?= $row['title']; ?></a></h5>
                                    <p><?= $row['summary']; ?></p>
                                    <a href="tintuc.php?id=<?= $row['id']; ?>" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="col-lg-12">
                            <div class="product__pagination blog__pagination">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

<?php
require_once './components/footer.php';
?>