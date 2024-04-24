<?php
require 'includes/header.php';
require '../db/conn.php';

// function avatar($arrstr) {
//     // $arrstr la mang cac anh co dang anh1; anh2; anh3
//     // tach chuoi thanh mang - tach voi ;
//     // $arr = $arrstr.str_split(';');
//     $arr = explode(';', $arrstr);
//     return "<img src='$arr[0]' height=120px>";
// }
?>

<div class="">
    <h1>Bai Viet</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sach Bai Viet</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Title</th>
                        <th>images</th>
                        <th>Categories</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Number</th>
                        <th>Title</th>
                        <th>images</th>
                        <th>Categories</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Operation</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $sql_str = "SELECT *, news.id as nid, news.status as nstatus, newscategories.name as dmtin FROM news, newscategories WHERE news.newscategory_id = newscategories.id ORDER BY news.created_at;";
                    $result = mysqli_query($conn, $sql_str);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <th><?=$i++;?></th>
                            <td><?= substr($row['title'], 0, 30) . "..."; ?></td>
                            <td><img src="<?= $row['images'];?>" height=120px> </td>
                            <td><?= $row['dmtin'];?></td>
                            <td><?= substr($row['description'], 0, 26) . "..."; ?></td>
                            <td><?= $row['nstatus']; ?></td>
                            <td>
                                
                                <a href="editnews.php?id=<?= $row['nid']; ?>" class="btn btn-warning m-1">EDIT</a>
                                <a href="deletenews.php?id=<?= $row['nid']; ?>" class="btn btn-danger" onclick="return confirm('Ban co chac chan muon xoa !')">DELETE</a>
                            </td>
                        </tr>

                        <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
require 'includes/footer.php';
?>