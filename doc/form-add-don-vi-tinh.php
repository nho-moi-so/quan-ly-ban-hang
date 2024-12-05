<?php
include "connect.php";
require_once 'auth.php';
checkLogin();
checkAdmin(['Admin']);
$currentRole = $_SESSION['user_role'];

function generateUnitCode($conn) {
    // Prepare SQL to get the maximum unit of measurement code
    $sql = "SELECT MaDVT FROM donvitinh ORDER BY CAST(MaDVT AS UNSIGNED) DESC LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastCode = $row['MaDVT'];
        
        // Safely extract the numeric part and increment
        $numericPart = intval(preg_replace('/[^0-9]/', '', $lastCode));
        
        // Increment the numeric part
        $newNumericPart = $numericPart + 1;
        
        // Format the new code with leading zeros
        $newCode = str_pad($newNumericPart, 2, '0', STR_PAD_LEFT);
    } else {
        // If no existing codes, start with 0001
        $newCode = '';
    }
    
    return $newCode;
}

// Xử lý chỉnh sửa - lấy thông tin đơn vị để điền vào form
$editUnit = null;
if (isset($_GET['sua']) && isset($_GET['id'])) {
    $MaDVT = $_GET['id'];
    $sql = "SELECT * FROM donvitinh WHERE MaDVT = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $MaDVT);
    $stmt->execute();
    $result = $stmt->get_result();
    $editUnit = $result->fetch_assoc();
}

// Generate unit code if not in edit mode
$autoGeneratedCode = $editUnit ? $editUnit['MaDVT'] : generateUnitCode($conn);
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
      <?php if (in_array($currentRole, ['Admin'])): ?>
        <li><a class="app-menu__item" href="./quan-ly-xuat-xu.php"><i class='app-menu__icon bx bx-task'></i><span
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
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">Danh Sách Đơn Vị Tính</li>
                <li class="breadcrumb-item"><a href="#">Thêm Đơn Vị Tính</a></li>
            </ul>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="col-sm-2">
                    <li class="btn btn-add btn-sm">
                        <a href="table-data-don-vi-tinh.php"><i class="fas fa-plus"></i>Danh Sách Đơn Vị Tính</a>
                    </li>
                </div>
                <div class="tile">
                    <h3 class="tile-title">
                        <?php echo $editUnit ? 'Chỉnh Sửa Đơn Vị Tính' : 'Thêm Đơn Vị Tính Mới'; ?>
                    </h3>

                    <?php 
                    // Xử lý thêm, sửa đơn vị tính
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['them_donvi'])) {
                            $MaDVT = $_POST['MaDVT'];
                            $TenDVT = $_POST['TenDVT'];

                            // Kiểm tra xem mã đơn vị đã tồn tại chưa
                            $checkExist = "SELECT * FROM donvitinh WHERE MaDVT = ?";
                            $stmt = $conn->prepare($checkExist);
                            $stmt->bind_param("s", $MaDVT);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $error = "Mã đơn vị đã tồn tại. Vui lòng chọn mã khác.";
                            } else {
                                // Chuẩn bị câu truy vấn INSERT
                                $sql = "INSERT INTO donvitinh (MaDVT, TenDVT) VALUES (?, ?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("ss", $MaDVT, $TenDVT);

                                if ($stmt->execute()) {
                                    $success = "Thêm đơn vị tính mới thành công.";
                                } else {
                                    $error = "Lỗi: " . $stmt->error;
                                }
                            }
                        }

                        if (isset($_POST['sua_donvitinh'])) {
                            $MaDVT = $_POST['MaDVT'];
                            $TenDVT = $_POST['TenDVT'];
                        
                            $sql = "UPDATE donvitinh SET TenDVT = ? WHERE MaDVT = ?";
                            $stmt = $conn->prepare($sql);
                            
                            if (!$stmt) {
                                // Check for statement preparation error
                                die("Prepare failed: " . $conn->error);
                            }
                            
                            $stmt->bind_param("ss", $TenDVT, $MaDVT);
                        
                            if ($stmt->execute()) {
                                if ($stmt->affected_rows > 0) {
                                    $success = "Cập nhật đơn vị tính thành công.";
                                    exit();
                                } else {
                                    $error = "Không có dòng nào được cập nhật. Kiểm tra mã đơn vị.";
                                }
                            } else {
                                $error = "Lỗi: " . $stmt->error;
                            }
                            
                            // Close statement
                            $stmt->close();
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
                            <div class="form-group col-md-3">
                                <label class="control-label">Mã Đơn Vị Tính</label>
                                <input class="form-control" 
                                    name="MaDVT" 
                                    type="text" 
                                    value="<?php echo htmlspecialchars($autoGeneratedCode); ?>" 
                                    <?php echo $editUnit ? 'readonly' : ''; ?> 
                                    placeholder="Mã đơn vị tính">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Tên Đơn Vị</label>
                                <input class="form-control" 
                                       name="TenDVT" 
                                       type="text" 
                                       value="<?php echo $editUnit ? htmlspecialchars($editUnit['TenDVT']) : ''; ?>" 
                                       placeholder="Nhập tên đơn vị tính" 
                                       required>
                            </div>

                            <div class="form-group">
                                <?php if ($editUnit): ?>
                                    <div class="form-group col-md-12">
                                    <button class="btn btn-save" type="submit" name="sua_donvitinh">
                                        <i class="fas fa-edit"></i> Cập Nhật
                                    </button>
                                    <a class="btn btn-cancel" href="table-data-don-vi-tinh.php"> Hủy bỏ </a>
                                    </div>
                                <?php else: ?>
                                    <div class="form-group col-md-12">
                                         <button class="btn btn-save" type="submit" name="them_donvi">
                                        <i class="fas fa-plus"></i> Lưu lại 
                                        </button>
                                    <a class="btn btn-cancel" href="table-data-don-vi-tinh.php"> Hủy bỏ </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
<?php 
// Đóng kết nối
$conn->close(); 
?>