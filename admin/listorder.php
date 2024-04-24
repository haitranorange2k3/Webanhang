<?php
require 'includes/header.php';
require '../db/conn.php';

function ChanceColor($str) {
    if ($str == 'Cancelled') {
        echo '<h4><span class="badge bg-danger text-white ">'.$str.'</span></h4>';
    } elseif ($str == 'Shipping') {
        echo '<h4><span class="badge bg-success text-white ">'.$str.'</span></h4>';
    } elseif ($str == 'Confirmed') {
        echo '<h4><span class="badge bg-primary text-white ">'.$str.'</span></h4>';
    } elseif ($str == 'Processing') {
        echo '<h4><span class="badge bg-warning text-white ">'.$str.'</span></h4>';
    } elseif ($str == 'Delivered') {
        echo '<h4><span class="badge bg-secondary text-white ">'.$str.'</span></h4>';
    }
}
?>

<div class="">
    <h1>Don hang</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sach Don hang</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Code</th>
                        <th>Date Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Number</th>
                        <th>Code</th>
                        <th>Date Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $sql_str = "SELECT * FROM orders ORDER BY created_at;";
                    $result = mysqli_query($conn, $sql_str);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?=$i++;?></td>
                            <td><?=$row['id'];?></td>
                            <td><?=$row['created_at'];?></td>
                            <td><?php ChanceColor($row['status']) ;?></td>
                            <td>
                                <a href="viewsorders.php?id=<?= $row['id']; ?>" class="btn btn-outline-primary  m-1">SEE</a>
                                <!-- <a href="deletenews.php?id=<?//= $row['nid']; ?>" class="btn btn-danger" onclick="return confirm('Ban co chac chan muon xoa !')">DELETE</a> -->
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