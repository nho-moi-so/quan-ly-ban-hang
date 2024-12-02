<?php
include "connect.php";
require_once 'auth.php';
checkLogin();
checkAdmin(['Admin']);
$currentRole = $_SESSION['user_role'];

// Xử lý chỉnh sửa - lấy thông tin xuất xứ để điền vào form
$editOrigin = null;
if (isset($_GET['sua']) && isset($_GET['id'])) {
    $maXuatXu = $_GET['id'];
    $sql = "SELECT * FROM xuatxu WHERE MaXuatXu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $maXuatXu);
    $stmt->execute();
    $result = $stmt->get_result();
    $editOrigin = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thêm Xuất Xứ | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <style>
        .form-group {
            margin-bottom: 20px;
        }

        .btn-save {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-right: 10px;
        }

        .btn-cancel {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 15px;
        }

        .btn-save:hover, .btn-cancel:hover {
            opacity: 0.8;
        }

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
    <!-- Navbar -->
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
        <li><a class="app-menu__item active" href="./index.php"><i class='app-menu__icon bx bx-tachometer'></i><span
              class="app-menu__label">Bảng điều khiển</span></a></li>
      <?php endif; ?>
      <?php if (in_array($currentRole, ['Admin'])): ?>
        <li><a class="app-menu__item " href="./table-data-table.php"><i class='app-menu__icon bx bx-id-card'></i> <span
              class="app-menu__label">Quản lý nhân viên</span></a></li>
      <?php endif; ?>
      <?php if (in_array($currentRole, ['Admin', 'NV'])): ?>
        <li><a class="app-menu__item" href="./table-data-khachhang.php"><i class='app-menu__icon bx bx-user-voice'></i><span
              class="app-menu__label">Quản lý khách hàng</span></a></li>
      <?php endif; ?>
      <?php if (in_array($currentRole, ['Admin'])): ?>
        <li><a class="app-menu__item" href="./table-data-product.php"><i
              class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
        </li>
      <?php endif; ?>
      <?php if (in_array($currentRole, ['Admin'])): ?>
        <li><a class="app-menu__item" href="./table-data-oder.php"><i class='app-menu__icon bx bx-task'></i><span
              class="app-menu__label">Quản lý đơn hàng</span></a></li>
      <?php endif; ?>

      <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Cài
            đặt hệ thống</span></a></li>
        </ul>
    </aside>

    <main class="app-content">
        <div class="app-title">
                <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> Danh sách xuất xứ </li>
                 <li class="breadcrumb-item"><a href="#">Thêm Xuất Xứ</a></li> 
                </ul>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="col-sm-2">
                  <li class="btn btn-add btn-sm"data-toggle="modal" data-target="#addxuatxu" >
                    <a href="table-data-xuat-xu.php"><i class="fas fa-plus"></i>Danh Sách Xuất Xứ</a></li>
                </div>
                <div class="tile">
                    <h3 class="tile-title">
                        <?php echo $editOrigin ? 'Chỉnh Sửa Xuất Xứ' : 'Thêm Xuất Xứ Mới'; ?>
                    </h3>

                    <?php 
                    // Xử lý thêm, sửa xuất xứ
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['xuatxu'])) {
                            $MaXuatXu = $_POST['MaXuatXu'];
                            $TenXuatXu = $_POST['TenXuatXu'];
                            $moTa = $_POST['MoTa'] ?? '';

                            // Kiểm tra xem mã xuất xứ đã tồn tại chưa
                            $checkExist = "SELECT * FROM xuatxu WHERE MaXuatXu = ?";
                            $stmt = $conn->prepare($checkExist);
                            $stmt->bind_param("s", $MaXuatXu);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $error = "Mã xuất xứ đã tồn tại. Vui lòng chọn mã khác.";
                            } else {
                                // Chuẩn bị câu truy vấn INSERT
                                $sql = "INSERT INTO xuatxu (MaXuatXu, TenXuatXu, MoTa) VALUES (?, ?, ?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("sss", $MaXuatXu, $TenXuatXu, $moTa);

                                if ($stmt->execute()) {
                                    $success = "Thêm xuất xứ mới thành công.";
                                } else {
                                    $error = "Lỗi: " . $stmt->error;
                                }
                            }
                        }

                        // Xử lý sửa xuất xứ
                        if (isset($_POST['SuaXuatXu'])) {
                            $MaXuatXu = $_POST['MaXuatXu'];
                            $TenXuatXu = $_POST['TenXuatXu'];
                            $moTa = $_POST['MoTa'] ?? '';

                            $sql = "UPDATE xuatxu SET TenXuatXu = ?, MoTa = ? WHERE MaXuatXu = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sss", $TenXuatXu, $moTa, $MaXuatXu);

                            if ($stmt->execute()) {
                                $success = "Cập nhật xuất xứ thành công.";
                                // Redirect to list page after successful update
                                header("Location quan-ly-xuat-xu.php");
                                exit();
                            } else {
                                $error = "Lỗi: " . $stmt->error;
                            }
                        }
                    }
                    
                    // Hiển thị thông báo lỗi hoặc thành công
                    if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>

                    <div class="tile-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label">Mã Xuất Xứ</label>
                                <input class="form-control" 
                                       name="MaXuatXu" 
                                       type="text" 
                                       value="<?php echo $editOrigin ? htmlspecialchars($editOrigin['MaXuatXu']) : ''; ?>"
                                       <?php echo $editOrigin ? 'readonly' : ''; ?> 
                                       placeholder="Nhập mã xuất xứ" 
                                       required>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Tên Xuất Xứ</label>
                                <input class="form-control" 
                                       name="TenXuatXu" 
                                       type="text" 
                                       value="<?php echo $editOrigin ? htmlspecialchars($editOrigin['TenXuatXu']) : ''; ?>" 
                                       placeholder="Nhập tên xuất xứ" 
                                       required>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Mô Tả</label>
                                <textarea class="form-control" 
                                          name="MoTa" 
                                          rows="4" 
                                          placeholder="Nhập mô tả (tùy chọn)"><?php 
                                              echo $editOrigin ? htmlspecialchars($editOrigin['MoTa']) : ''; 
                                          ?></textarea>
                            </div>

                            <div class="form-group">
                                <?php if ($editOrigin): ?>
                                    <button class="btn btn-save" type="submit" name="SuaXuatXu">
                                        <i class="fas fa-edit"></i> Cập Nhật
                                    </button>
                                    <a href="danh-sach-xuat-xu.php" class="btn btn-cancel">
                                        <i class="fas fa-times"></i> Hủy
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-save" type="submit" name="xuatxu">
                                        <i class="fas fa-plus"></i> Thêm Mới
                                    </button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
        </div>
    </main>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?php 
// Đóng kết nối
$conn->close(); 
?>