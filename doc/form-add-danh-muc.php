<?php
include "connect.php";
require_once 'auth.php';
checkLogin();
checkAdmin(['Admin']);
$currentRole = $_SESSION['user_role'];



function generateCategoryCode($conn) {
    // Use MAX to get the highest numeric code, ignoring deleted entries
    $sql = "SELECT MAX(CAST(MaDanhMuc AS UNSIGNED)) AS MaxCode FROM danhmucsp";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        error_log("SQL Prepare Error: " . $conn->error);
        return '01'; // Default code if query fails
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastNumericCode = $row['MaxCode'];
        
        // Increment the numeric part
        $newNumericPart = $lastNumericCode ? $lastNumericCode + 1 : 1;
        
        // Format the new code with leading zeros
        $newCode = str_pad($newNumericPart, 2, '0', STR_PAD_LEFT);
    } else {
        // If no existing codes, start with 01
        $newCode = '01';
    }
    
    return $newCode;
}
/*function generateCategoryCode($conn) {
    // Prepare SQL to get the maximum category code
    $sql = "SELECT MaDanhMuc FROM danhmucsp ORDER BY CAST(MaDanhMuc AS UNSIGNED) DESC LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastCode = $row['MaDanhMuc'];
        
        // Safely extract the numeric part and increment
        $numericPart = intval(preg_replace('/[^0-9]/', '', $lastCode));
        
        // Increment the numeric part
        $newNumericPart = $numericPart + 1;
        
        // Format the new code with leading zeros
        $newCode = str_pad($newNumericPart, 2, '0', STR_PAD_LEFT);
    } else {
        // If no existing codes, start with 01
        $newCode = '01';
    }
    
    return $newCode;
}*/
// Handle editing - retrieve category information to fill the form
$editCategory = null;
if (isset($_GET['sua']) && isset($_GET['id'])) {
    $MaDanhMuc = $_GET['id'];
    $sql = "SELECT * FROM danhmucsp WHERE MaDanhMuc = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $MaDanhMuc);
    $stmt->execute();
    $result = $stmt->get_result();
    $editCategory = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quản Lý Danh Mục | Quản trị Admin</title>
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
            <!-- Sidebar navigation remains the same as in the original file -->
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item" href="./table-data-danh-muc.php"><i class='app-menu__icon bx bx-task'></i><span
                    class="app-menu__label">Quản lý danh mục</span></a></li>
            <?php endif; ?>
            <!-- Other menu items -->
        </ul>
    </aside>
    
    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">Danh sách danh mục</li>
                <li class="breadcrumb-item"><a href="#">Thêm Danh Mục</a></li> 
            </ul>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="col-sm-2">
                    <li class="btn btn-add btn-sm" data-toggle="modal" data-target="#adddanhmuc">
                        <a href="table-data-danh-muc.php"><i class="fas fa-plus"></i>Danh Sách Danh Mục</a>
                    </li>
                </div>
                <div class="tile">
                    <h3 class="tile-title">
                        <?php echo $editCategory ? 'Chỉnh Sửa Danh Mục' : 'Thêm Danh Mục Mới'; ?>
                    </h3>

                    <?php 
                    // Handle adding and editing category
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['danhmuc'])) {
                            // Automatically generate category code if not provided
                            $MaDanhMuc = generateCategoryCode($conn);
                            $TenDanhMuc = $_POST['TenDanhMuc'];
                            $MoTa = $_POST['MoTa'] ?? ''; // Optional description

                            // Prepare INSERT query
                            $sql = "INSERT INTO danhmucsp (MaDanhMuc, TenDanhMuc,MoTa) VALUES (?, ?,?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sss", $MaDanhMuc, $TenDanhMuc,$MoTa);

                            if ($stmt->execute()) {
                                $success = "Thêm danh mục mới thành công. Mã danh mục: " . $MaDanhMuc;
                            } else {
                                $error = "Lỗi: " . $stmt->error;
                            }
                        
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("sss", $TenDanhMuc,$MaDanhMuc, $MoTa);


                        // Handle editing category
                        /*if (isset($_POST['SuaDanhMuc'])) {
                            $MaDanhMuc = $_POST['MaDanhMuc'];
                            $TenDanhMuc = $_POST['TenDanhMuc'];
                    
                            $sql = "UPDATE danhmucsp SET TenDanhMuc = ? WHERE MaDanhMuc = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ss", $TenDanhMuc,$MaDanhMuc, $MoTa);

                            if ($stmt->execute()) {
                                $success = "Cập nhật danh mục thành công.";
                                // Redirect to list page after successful update
                                header("Location: form-add-danh-muc.php");
                                exit();
                            } else {
                                $error = "Lỗi: " . $stmt->error;
                            }
                        }*/
                    }
                }
                    
                    // Display error or success messages
                    if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>

                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>

                    <div class="tile-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label">Mã Danh Mục</label>
                                <input class="form-control" 
                                       name="MaDanhMuc" 
                                       type="text" 
                                       value="<?php echo $editCategory ? htmlspecialchars($editCategory['MaDanhMuc']) : generateCategoryCode($conn); ?>"
                                       readonly 
                                       placeholder="Nhập mã danh mục" 
                                       required>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Tên Danh Mục</label>
                                <input class="form-control" 
                                       name="TenDanhMuc" 
                                       type="text" 
                                       value="<?php echo $editCategory ? htmlspecialchars($editCategory['TenDanhMuc']) : ''; ?>" 
                                       placeholder="Nhập tên danh mục" 
                                       required>
                            </div>

                             <div class="form-group">
                                <label class="control-label">Mô Tả (Tùy Chọn)</label>
                                <textarea class="form-control" 
                                          name="MoTa" 
                                          placeholder="Nhập mô tả danh mục"><?php echo $editCategory ? htmlspecialchars($editCategory['MoTa']) : ''; ?></textarea>
                            </div> 

                            <div class="form-group">
                                <?php if ($editCategory): ?>
                                    <button class="btn btn-save" type="submit" name="SuaDanhMuc">
                                        <i class="fas fa-edit"></i> Cập Nhật
                                    </button>
                                <?php else: ?>
                                    <div class="form-group col-md-12">
                                        <button class="btn btn-save" type="submit" name="danhmuc">
                                            <i class="fas fa-plus"></i> Lưu lại       
                                        </button>
                                        <a class="btn btn-cancel" href="table-data-danh-muc.php"> Hủy bỏ </a>
                                    </div>
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
// Close the connection
$conn->close(); 
?>