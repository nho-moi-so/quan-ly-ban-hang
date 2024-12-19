<?php
include "connect.php";
require_once 'auth.php';
checkLogin();
checkAdmin(['Admin']);
$currentRole = $_SESSION['user_role'];
$current_page = basename($_SERVER['PHP_SELF']);

// Xử lý xóa xuất xứ
$success = '';
$error = '';

if (isset($_GET['xoa']) && isset($_GET['id'])) {
    $MaXuatXu = $_GET['id'];

    $sql = "DELETE FROM xuatxu WHERE MaXuatXu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $MaXuatXu);

    if ($stmt->execute()) {
        $success = "Xóa xuất xứ thành công.";
    } else {
        $error = "Lỗi: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh Sách Xuất Xứ | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
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

        .tile-body .table td.text-center {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

<body class="app sidebar-mini rtl">
    <!-- Navbar -->
    <header class="app-header">
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <ul class="app-nav">
            <li><a class="app-nav__item" href="logout.php"><i class='bx bx-log-out bx-rotate-180'></i></a></li>
        </ul>
    </header>

    <!-- Sidebar menu -->
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
                            class="app-menu__label">Xem Chi Tiết Hóa Đơn</span></a></li>
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
                <li class="breadcrumb-item"> Danh sách xuất xứ </li>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-2">
                    <li class="btn btn-add btn-sm" data-toggle="modal" data-target="#addxuatxu">
                        <a href="form-add-xuat-xu.php"><i class="fas fa-plus"></i> Thêm xuất xứ mới</a>
                    </li>
                </div>

                <?php
                // Hiển thị thông báo lỗi hoặc thành công
                if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>

                <div class="tile">
                    <div class="tile-title d-flex justify-content-between align-items-center">
                        <h3>Danh Sách Xuất Xứ</h3>
                    </div>
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="xuatXuTable">
                            <thead>
                                <tr>
                                    <th>Mã Xuất Xứ</th>
                                    <th>Tên Xuất Xứ</th>
                                    <th>Chức Năng</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                // Truy vấn lấy danh sách xuất xứ từ database
                                $sql = "SELECT * FROM xuatxu ORDER BY MaXuatXu";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['MaXuatXu']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['TenXuatXu']) . "</td>";
                                        echo "<td class='text-center'>
                                                <a href='sua-xuat-xu.php?sua&id=" . urlencode($row['MaXuatXu']) . "' class='btn btn-primary btn-sm edit' type='button' title='Sửa'>
                                                    <i class='fas fa-edit'></i>
                                                </a>
                                                <a href='?xoa&id=" . urlencode($row['MaXuatXu']) . "' onclick='return confirmDelete()' class='btn btn-danger btn-sm delete ml-2' type='button' title='Xóa'>
                                                    <i class='fas fa-trash-alt'></i>
                                                </a>
                                              </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='text-center'>Không có dữ liệu xuất xứ</td></tr>";
                                }
                                // Xử lý sửa xuất xứ

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function confirmDelete() {
            return confirm('Bạn có chắc chắn muốn xóa xuất xứ này không?');
        }

        // Optional: DataTables initialization if you want advanced table features
        $(document).ready(function() {
            $('#xuatXuTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Tất cả"]
                ],
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ dòng",
                    "zeroRecords": "Không tìm thấy dữ liệu",
                    "info": "Trang _PAGE_/_PAGES_",
                    "infoEmpty": "Không có dữ liệu",
                    "search": "Tìm kiếm:",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Tiếp",
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