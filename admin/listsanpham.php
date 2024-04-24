<?php
require 'includes/header.php';
require '../db/conn.php';

function avatar($arrstr) {
    // $arrstr la mang cac anh co dang anh1; anh2; anh3
    // tach chuoi thanh mang - tach voi ;
    // $arr = $arrstr.str_split(';');
    $arr = explode(';', $arrstr);
    return "<img src='$arr[0]' height=120px>";
}
?>

<div class="">
    <h1>San pham</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sach San Pham</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>images</th>
                        <th>Categories</th>
                        <th>Brand</th>
                        <th>Status</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>images</th>
                        <th>Categories</th>
                        <th>Brand</th>
                        <th>Status</th>
                        <th>Operation</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $sql_str = "SELECT products.id as id, products.name as pname, images, categories.name as cname, brands.name as bname, products.status as pstatus
                    FROM products, categories, brands WHERE products.category_id=categories.id and products.brand_id = brands.id
                    ORDER BY products.name ";
                    $result = mysqli_query($conn, $sql_str);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?= $row['pname']; ?></td>
                            <td><?= avatar($row['images']);?></td>
                            <td><?= $row['cname']; ?></td>
                            <td><?= $row['bname']; ?></td>
                            <td><?= $row['pstatus']; ?></td>
                            <td>
                                
                                <a href="editproduct.php?id=<?= $row['id']; ?>" class="btn btn-warning m-1">EDIT</a>
                                <a href="deleteproduct.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Ban co chac chan muon xoa !')">DELETE</a>
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