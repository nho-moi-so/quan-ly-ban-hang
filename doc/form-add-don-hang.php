<?php
include "connect.php";
require_once 'auth.php';
checkLogin();
checkAdmin(['Admin', 'NV']);
$currentRole = $_SESSION['user_role'];

// Handle form submission
/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $ma_don_hang = $_POST['ma_don_hang'];
    $ho_ten = $_POST['ho_ten'];
    $TenSP = $_POST['TenSP'];
    $MaSP =$_POST['MaSP'];
    $ngay_ban = date('Y-m-d H:i:s', strtotime($_POST['ngay_ban']));
    //$ngay_ban = $_POST['ngay_ban'];

    $MaKH = $_POST['MaKH'];
    $MaPTTT = $_POST['MaPTTT'];
    $so_luong = $_POST['so_luong'];
    $tinh_trang = $_POST['tinh_trang'];
    $ghi_chu = $_POST['ghi_chu'];*/

// Trước khi tính tổng tiền, lấy MaSP từ TenSP
$sql_price = "SELECT  DonGia FROM sanpham WHERE TenSP = ?";
$stmt_price = $conn->prepare($sql_price);
$stmt_price->bind_param("s", $TenSP);
$stmt_price->execute();
$result_price = $stmt_price->get_result();
$price_row = $result_price->fetch_assoc();
//$MaSP = $price_row['MaSP'];
//$DonGia = $price_row['DonGia'] * $so_luong;

// Sau đó dùng $MaSP trong câu INSERT
    // Calculate total price (you may need to adjust this logic)
    $sql_price = "SELECT MaSP DonGia FROM sanpham WHERE TenSP = ?";
    $stmt_price = $conn->prepare($sql_price);
    $stmt_price->bind_param("s", $TenSP);
    $stmt_price->execute();
    $result_price = $stmt_price->get_result();
    $price_row = $result_price->fetch_assoc();
    //$DonGia = $price_row['DonGia'] * $so_luong;

    // Prepare SQL to insert order
    $sql = "INSERT INTO donhang (
        ma_don_hang, 
        TenSP, 
        ngay_ban, 
        khach_hang, 
        MaPTTT, 
        so_luong, 
        tinh_trang, 
        ghi_chu,
        DonGia
    ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  // $stmt = $conn->prepare($sql);

  //$result = $conn->query($sql);
  /*  $stm -> bind_param("sssssssss") (
      $ma_don_hang,
      $TenSP, 
      $MaSP
      $ngay_ban, 
      $MaKH, 
      $MaPTTT, 
      $so_luong, 
      $tinh_trang, 
      $ghi_chu,
      $tong_tien,
      $DonGia
    );*/
      // Prepare the statement before binding parameters
      //*$stmt = $conn->prepare($sql);
     /* if ($stmt === false) {
    // Handle preparation error
    die("Prepare failed: " . $conn->error);
    }*/
    //$stmt = $conn->prepare($sql);
    //$stmt->bind_param("sssssssss", 
    /*$stmt->bind_param("ssssisissd", 
        $ma_don_hang
        $TenSP,
        $ngay_ban,
        $MaKH,
        $MaPTTT,
        $so_luong,
        $tinh_trang,
        $ghi_chu,
        $tong_tien,
        $DonGia
        
    );*/
  
  
    //Xử lý lỗi và chuyển hướng 
      /*if ($stmt->execute()) {
      header("Location: table-data-oder.php?success=1&message=" . urlencode("Đơn hàng đã được thêm thành công"));
      exit();
      } else {
        $error = "Lỗi: " . $stmt->error;
      }

    //if ($result && $result->num_rows > 0): {
    /*if ($stmt->execute()) {
        // Redirect to order list page with success message
        header("Location: table-data-oder.php?success=1&message=" . urlencode("Đơn hàng đã được thêm thành công"));
        exit();
    } else {
         //Handle error
       $error = "Lỗi: " . $stmt->error;
    }*/

$editOrigin = null;
if (isset($_GET['sua']) && isset($_GET['id'])) {
    $ma_don_hang = $_GET['id'];
    $sql = "SELECT * FROM donhang WHERE ma_don_hang = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ma_don_hang);
    $stmt->execute();
    $result = $stmt->get_result();
    $editOrigin = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Danh sách đơn hàng | Quản trị Admin</title>
  <!-- ... (previous head content remains the same) ... -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- or -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  
</head>

<body onload="time()" class="app sidebar-mini rtl">
   <!-- Navbar-->
   <header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
      aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">

      <!-- User Menu-->
      <li><a class="app-nav__item" href="logout.php"><i class='bx bx-log-out bx-rotate-180'></i></a></li>

    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../img-sanpham/avatar-trang-2.jpg" width="50px"
        alt="User Image">
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
        <li><a class="app-menu__item" href="./index.php"><i class='app-menu__icon bx bx-tachometer'></i><span
              class="app-menu__label">Bảng điều khiển</span></a></li>
      <?php endif; ?>
      <?php if (in_array($currentRole, ['Admin'])): ?>
        <li><a class="app-menu__item" href="./table-data-table.php"><i class='app-menu__icon bx bx-id-card'></i> <span
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
        <li><a class="app-menu__item active" href="./table-data-oder.php"><i class='app-menu__icon bx bx-task'></i><span
              class="app-menu__label">Quản lý đơn hàng</span></a></li>
      <?php endif; ?>

      <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Cài
            đặt hệ thống</span></a></li>
    </ul>
  </aside>
  
    <main class="app-content">
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item">Danh sách đơn hàng</li>
          <li class="breadcrumb-item"><a href="table-data-oder.php">Thêm đơn hàng</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
             <h3 class="tile-title">Tạo mới đơn hàng</h3>
            <div class="tile-body">
              <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
              <?php endif; ?>
              <form class="row" method="POST" action="">
                <div class="form-group col-md-4">
                  <label class="control-label">Mã đơn hàng</label>
                  <input class="form-control" type="text" name="ma_don_hang" id="order_code" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label class="employee" class="control-employeeId">Mã nhân viên</label>
                  <select class="form-control" id="employeeId" name="ho_ten"required>
                   <option value="">Chọn mã nhân viên</option>
                   <?php
                   $sql = "SELECT ID, ho_ten FROM nhanvien";
                   $result = $conn->query($sql);
                   if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo '<option value="' . $row['ID'] . '">' . $row['ho_ten'] . '</option>';
                    }
                  }
                   ?>
                   </select>
                </div>
                <div class="form-group col-md-4">
                   <label for="product" class="control-product">Tên sản phẩm</label>
                   <select class="form-control" id="product" name="MaSP" required>
                     <option value="">Chọn sản phẩm</option>
                  <?php
                  $sql = "SELECT MaSP, TenSP FROM sanpham";
                  $result = $conn->query($sql);
                  if ($result) {
                  while ($row = $result->fetch_assoc()) {
                  echo '<option value ="' .$row['MaSP'] .'">' .$row['TenSP'] . '</option>';
                   }
                  }
                ?>
                </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="control-label">Ngày giờ bán</label>
                  <input 
                    class="form-control" 
                    type="datetime-local" 
                    name="ngay_ban"
                    required
                    value="<?php echo date('Y-m-d\TH:i'); ?>"
                  />
                </div>               
                <div class="form-group col-md-4">
                <label for="khachHangSelect" class="control-label">Khách hàng</label>
                <select class="form-control" name="MaKH" id="khachHangSelect" required>
                  <option value="">-- Chọn khách hàng --</option>
                  <?php
                  $sql = "SELECT MaKH, TenKH FROM khachhang";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo '<option value="' . $row['MaKH'] . '">' . $row['TenKH'] . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
                <div class="form-group col-md-4">
                  <label for="paymentMethod" class="control-label">Phương Thức Thanh Toán:</label>
                  <select class="form-control" id="paymentMethod" name="MaPTTT" required>
                      <option value="">Chọn phương thức thanh toán</option>
                      <option value="cash">Tiền mặt</option>
                      <option value="card">Thẻ ngân hàng</option>
                      <option value="transfer">Chuyển khoản</option>
                      <option value="momo">Ví MoMo</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="control-label">Số lượng</label>
                  <input class="form-control" type="number" name="so_luong" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="exampleSelect1" class="control-label">Tình trạng</label>
                  <select class="form-control" id="exampleSelect1" name="tinh_trang" required>
                    <option value="">-- Chọn tình trạng --</option>
                    <option value="Đã xử lý">Đã xử lý</option>
                    <option value="Đang chờ">Đang chờ</option>
                    <option value="Đã hủy">Đã hủy</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="control-label">Ghi chú đơn hàng</label>
                  <textarea class="form-control" rows="4" name="ghi_chu"></textarea>
                </div>
                <div>
                  <button class="btn btn-save" type="submit">Lưu lại</button>
                  <a class="btn btn-cancel" href="table-data-oder.php">Hủy bỏ</a>
                </div>
              </form>
           </div>
         </div>
       </div> 
      </div>
   </main>

   <script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to generate order code
    function generateOrderCode() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        
        // Format: DH + YYYYMMDD
        const orderCode = 'DH' + year + month + day;
        
        // Set the order code input field
        const orderCodeInput = document.getElementById('order_code');
        if (orderCodeInput) {
            orderCodeInput.value = orderCode;
        }
    }

    // Call the function when the page loads
    generateOrderCode();

    // Optional: Update if datetime-local changes
    const datetimeInput = document.querySelector('input[type="datetime-local"]');
    if (datetimeInput) {
        datetimeInput.addEventListener('change', generateOrderCode);
    }
});
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Function to generate order code
    function generateOrderCode() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        
        // Retrieve existing orders from localStorage or initialize
        let orders = JSON.parse(localStorage.getItem('orderCodes')) || [];
        
        // Calculate the sequence number for today
        const todayPrefix = year + month + day;
        const todayOrders = orders.filter(code => code.startsWith('DH' + todayPrefix));
        const sequenceNumber = todayOrders.length + 1;
        
        // Format: DH + YYYYMMDD - sequence number
        const orderCode = `DH${todayPrefix}-${String(sequenceNumber).padStart(3, '0')}`;
        
        // Add to localStorage
        orders.push(orderCode);
        localStorage.setItem('orderCodes', JSON.stringify(orders));
        
        // Set the order code input field
        const orderCodeInput = document.getElementById('order_code');
        if (orderCodeInput) {
            orderCodeInput.value = orderCode;
        }
    }

    // Call the function when the page loads
    generateOrderCode();

    // Optional: Update if datetime-local changes
    const datetimeInput = document.querySelector('input[type="datetime-local"]');
    if (datetimeInput) {
        datetimeInput.addEventListener('change', generateOrderCode);
    }
});
</script>
   <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
</body>
</html>