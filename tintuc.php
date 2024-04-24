<?php
session_start(); 
$is_homepage = false;
require './components/header.php';
?>
<?php
require './db/conn.php';
$idnews = $_GET['id'];
$sql_str = "SELECT * FROM news WHERE id = '$idnews'";
$result = mysqli_query($conn, $sql_str);
while ($row = mysqli_fetch_assoc($result)) {
    // $images_arr = explode(';', $row['images']);
    ?>
    <!-- Blog Details Hero Begin -->
    <section class="blog-details-hero set-bg" data-setbg="img/blog/details/details-hero.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2><?= $row['title']; ?></h2>
                        <ul>
                            <li>By TVH</li>
                            <li><?= $row['created_at']; ?></li>
                            <li>8 Comments</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
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
                                <li><a href="">All</a></li>
                                <?php
                                $sql_str2 = "SELECT * FROM newscategories ORDER BY id LIMIT 0,5;";
                                $result2 = mysqli_query($conn, $sql_str2);
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    ?>
                                    <li><a href="#"><?= $row2['name']; ?>(20)</a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Tin Hay</h4>
                            <div class="blog__sidebar__recent">
                                <?php
                                $sql_str3 = "SELECT * FROM news ORDER BY RAND() LIMIT 3;";
                                $result3 = mysqli_query($conn, $sql_str3);
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    ?>
                                    <a href="tintuc.php?id=<?= $row3['id']; ?>" class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="./admin/<?= $row3['images']; ?>" width="70" height="70" style="object-fit: cover;">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6><?= $row3['title']; ?></h6>
                                            <span><?= $row3['created_at']; ?></span>
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
                                $query = "SELECT * FROM categories ORDER BY RAND() LIMIT 0,5";
                                $res = mysqli_query($conn, $query);
                                while ($r = mysqli_fetch_assoc($res)) {
                                    ?>
                                    <a href="#"><?= $r['name']; ?></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        <img src="./admin/<?= $row['images']; ?>" alt="">
                        <p><?= $row['description']; ?></p>
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="img/blog/details/details-author.jpg" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>Michael TVH</h6>
                                        <span>Admin</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Categories:</span> Food</li>
                                        <li><span>Tags:</span> All, Trending, Cooking, Healthy Food, Life Style</li>
                                    </ul>
                                    <div class="blog__details__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->
    <section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title">
                        <h2>Bai viet lien quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $query2 = "SELECT * FROM news WHERE newscategory_id='$row[newscategory_id]' AND id <> '$row[id]';";
                $res2 = mysqli_query($conn, $query2);
                while ($row3 = mysqli_fetch_assoc($res2)) {
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="./admin/<?= $row3['images']; ?>" alt="" height="200" style="object-fit: cover;">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i><?= $row3['created_at']; ?></li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="tintuc.php?id=<?= $row3['id']; ?>"><?= $row3['title']; ?></a></h5>
                            <p><?= $row3['summary']; ?></p>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Related Blog Section End -->


    <?php
}
?>
<?php
require_once './components/footer.php';
?>