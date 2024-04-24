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

<div class="">
    <h1>Tai khoan</h1>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sach Tai khoan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $sql_str = "SELECT * FROM admins ORDER BY name;";
                    $result = mysqli_query($conn, $sql_str);
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <th><?= $i++; ?></th>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['type']; ?></td>
                            <td><?= $row['status']; ?></td>
                            <td>
                                <a href="edituser.php?id=<?= $row['id']; ?>" class="btn btn-warning m-1">EDIT</a>
                                <a href="deleteuser.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Ban co chac chan muon xoa !')">DELETE</a>
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
}
require 'includes/footer.php';
?>