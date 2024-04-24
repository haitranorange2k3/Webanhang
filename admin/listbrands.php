<?php
require 'includes/header.php';
require '../db/conn.php';
?>

<div class="">
    <h1>Thuong hieu</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sach Thuong hieu</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Operation</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $sql_str = "SELECT * FROM brands ORDER BY name";
                    $result = mysqli_query($conn, $sql_str);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    
                        <tr>
                            <td><?=$row['name'];?></td>
                            <td><?=$row['slug'];?></td>
                            <td><?=$row['status'];?></td>
                            <td>
                                <a href="editbrand.php?id=<?=$row['id'];?>" class="btn btn-warning m-1 ">EDIT</a>
                                <a href="deletebrand.php?id=<?=$row['id'];?>" class="btn btn-danger" onclick="return confirm('Ban co chac chan muon xoa !')">DELETE</a>
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