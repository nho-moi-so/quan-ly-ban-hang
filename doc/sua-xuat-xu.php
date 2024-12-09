<?php
include "connect.php";
require_once 'auth.php';
checkLogin();
checkAdmin(['Admin']);

// Check if an ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Không tìm thấy mã xuất xứ.'); window.location='quan-ly-xuat-xu.php';</script>";
    exit();
}

$maXuatXu = $_GET['id'];

// Fetch the current origin details
$sql = "SELECT * FROM xuatxu WHERE MaXuatXu = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $maXuatXu);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Xuất xứ không tồn tại.'); window.location='quan-ly-xuat-xu.php';</script>";
    exit();
}

$row = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenXuatXu = $_POST['tenxuatxu'];
    $moTa = $_POST['mota'];

    // Validate inputs
    if (empty($tenXuatXu)) {
        $error = "Tên xuất xứ không được để trống.";
    } else {
        // Prepare update statement
        $updateSql = "UPDATE xuatxu SET TenXuatXu = ?, MoTa = ? WHERE MaXuatXu = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sss", $tenXuatXu, $moTa, $maXuatXu);

        if ($updateStmt->execute()) {
            echo "<script>
                    alert('Cập nhật xuất xứ thành công!');
                    window.location='quan-ly-xuat-xu.php';
                  </script>";
            exit();
        } else {
            $error = "Lỗi: " . $updateStmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sửa Xuất Xứ | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
</head>
<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header">
        <!-- Sidebar toggle button-->
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <!-- User Menu-->
            <li><a class="app-nav__item" href="logout.php"><i class='bx bx-log-out bx-rotate-180'></i></a></li>
        </ul>
    </header>
    
    <!-- Sidebar menu-->
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
              class="app-menu__label">Quản lý Hóa Đơn</span></a></li>
      <?php endif; ?>
      <?php if (in_array($currentRole, ['Admin'])): ?>
        <li><a class="app-menu__item" href="./table-data-danh-muc.php"><i class='app-menu__icon bx bx-task'></i><span
              class="app-menu__label">Quản lý Danh Mục</span></a></li>
      <?php endif; ?>>
      <?php if (in_array($currentRole, ['Admin'])): ?>
        <li><a class="app-menu__item" href="./table-data-xuat-xu.php"><i class='app-menu__icon bx bx-task'></i><span
              class="app-menu__label">Quản lý xuất xứ</span></a></li>
      <?php endif; ?>
      <?php if (in_array($currentRole, ['Admin'])): ?>
        <li><a class="app-menu__item" href="./table-data-don-vi-tinh.php"><i class='app-menu__icon bx bx-task'></i><span
              class="app-menu__label">Quản lý đơn vị tính</span></a></li>
      <?php endif; ?>

      <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Cài
            đặt hệ thống</span></a></li>

        </ul>
    </aside>

    <main class="app-content">
        <div class="app-title">
            <!-- <div>
                <h1><i class="fas fa-edit"></i> Sửa Xuất Xứ</h1>
            </div> -->
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><a href="quan-ly-xuat-xu.php">Quản Lý Xuất Xứ</a></li>
                <li class="breadcrumb-item">Sửa Xuất Xứ</li>
            </ul>
        </div>
        
        <div class="row">
            <div class="col-md-12">
            <div class="col-sm-2">
                  <li class="btn btn-add btn-sm"data-toggle="modal" data-target="#addxuatxu" >
                    <a href="table-data-xuat-xu.php"><i class="fas fa-plus"></i> Danh sách xuất xứ</a></li>     
            </div>
                <div class="tile">
                    <div class="tile-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <div class="tile">
                    <div class="tile-title d-flex justify-content-between align-items-center">
                        <h3>Sửa Xuất Xứ</h3>
                    </div>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label class="control-label">Mã Xuất Xứ</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($row['MaXuatXu']); ?>" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label">Tên Xuất Xứ <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="tenxuatxu" 
                                       value="<?php echo htmlspecialchars($row['TenXuatXu']); ?>" 
                                       required>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label">Mô Tả</label>
                                <textarea class="form-control" name="mota" rows="4"><?php echo htmlspecialchars($row['MoTa'] ?? ''); ?></textarea>
                            </div>
                            
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-edit"></i> Cập Nhật
                            </button>
                            <a href="quan-ly-xuat-xu.php" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Hủy
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript files -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>