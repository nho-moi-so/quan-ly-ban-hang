<?php
include "connect.php";
require_once 'auth.php';
checkLogin();
checkAdmin(['Admin']);
$currentRole = $_SESSION['user_role'];
$current_page = basename($_SERVER['PHP_SELF']);

// Xử lý xóa đơn vị
if (isset($_GET['xoa']) && isset($_GET['id'])) {
    $MaDVT = $_GET['id'];
    $sql = "DELETE FROM donvitinh WHERE MaDVT = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $MaDVT);

    if ($stmt->execute()) {
        $success = "Xóa đơn vị tính thành công.";
    } else {
        $error = "Lỗi: " . $stmt->error;
    }
}

// Truy vấn danh sách đơn vị
$sql = "SELECT * FROM donvitinh ORDER BY MaDVT";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản Lý Đơn Vị Tính | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
</head>

<body class="app sidebar-mini rtl">
    <!-- Navbar and Sidebar (Same as previous code) -->
    <header class="app-header">
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <ul class="app-nav">
            <li><a class="app-nav__item" href="logout.php"><i class='bx bx-log-out bx-rotate-180'></i></a></li>
        </ul>
    </header>

    <!-- Sidebar menu  -->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            <img class="app-sidebar__user-avatar" src="../img-sanpham/avatar-trang-2.jpg" width="50px" alt="User Image">
            <div>
                <p class="app-sidebar__user-name"><b>User</b></p>
                <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
            </div>
        </div>

        <hr>
        <ul class="app-menu">
            <?php if (in_array($currentRole, ['Admin', 'NV'])): ?>
                <li><a class="app-menu__item haha" href="./phan-mem-ban-hang.php"><i class='app-menu__icon bx bx-cart-alt'></i>
                        <span class="app-menu__label">POS Bán Hàng</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin', 'NV'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="./index.php"><i class='app-menu__icon bx bx-tachometer'></i><span
                            class="app-menu__label">Bảng điều khiển</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-table.php') ? 'active' : '' ?>" href="./table-data-table.php"><i class='app-menu__icon bx bx-id-card'></i> <span
                            class="app-menu__label">Quản lý nhân viên</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin', 'NV'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-khachhang.php') ? 'active' : '' ?>" href="./table-data-khachhang.php"><i class='app-menu__icon bx bx-user-voice'></i><span
                            class="app-menu__label">Quản lý khách hàng</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-product.php') ? 'active' : '' ?>" href="./table-data-product.php"><i
                            class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
                </li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-oder.php') ? 'active' : '' ?>" href="./table-data-oder.php"><i class='app-menu__icon bx bx-task'></i><span
                            class="app-menu__label">Quản lý Hóa Đơn</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-danh-muc.php') ? 'active' : '' ?>" href="./table-data-danh-muc.php"><i class='app-menu__icon bx bx-task'></i><span
                            class="app-menu__label">Quản lý Danh Mục</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-xuat-xu.php') ? 'active' : '' ?>" href="./table-data-xuat-xu.php"><i class='app-menu__icon bx bx-task'></i><span
                            class="app-menu__label">Quản lý xuất xứ</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-don-vi-tinh.php') ? 'active' : '' ?>" href="./table-data-don-vi-tinh.php"><i class='app-menu__icon bx bx-task'></i><span
                            class="app-menu__label">Quản lý đơn vị tính</span></a></li>
            <?php endif; ?>
            <!-- <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Cài
            đặt hệ thống</span></a></li> -->
        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">Danh Sách Đơn Vị Tính</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <a class="btn btn-add btn-sm" href="form-add-don-vi-tinh.php">
                                    <i class="fas fa-plus"></i>Thêm Đơn Vị Tính
                                </a>
                            </div>
                        </div>

                        <?php
                        if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>

                        <table class="table table-hover table-bordered" id="donvitinh">
                            <thead>
                                <tr>
                                    <th>Mã Đơn Vị</th>
                                    <th>Tên Đơn Vị</th>
                                    <th>Chức Năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['MaDVT']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['TenDVT']) . "</td>";
                                        echo "<td>
                                                <a href='form-add-don-vi-tinh.php?sua=1&id=" . htmlspecialchars($row['MaDVT']) . "' 
                                                   class='btn btn-primary btn-sm'>
                                                    <i class='fas fa-edit'></i>
                                                </a>
                                                <a href='table-data-don-vi-tinh.php?xoa=1&id=" . htmlspecialchars($row['MaDVT']) . "' 
                                                   class='btn btn-danger btn-sm btn-delete' 
                                                   onclick='return confirm(\"Bạn có chắc chắn muốn xóa đơn vị này?\");'>
                                                   <i class='fas fa-trash'></i>
                                                </a>
                                              </td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#donViTable').DataTable({
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ dòng",
                    "zeroRecords": "Không tìm thấy kết quả",
                    "info": "Trang _PAGE_/_PAGES_",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(lọc từ _MAX_ tổng số bản ghi)",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Sau",
                        "previous": "Trước"
                    }
                }
            });
        });
    </script>
</body>

</html>
<?php
// Đóng kết nối
$conn->close();
?>