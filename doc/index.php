<?php
session_start();
require_once 'auth.php';
checkLogin();
checkAdmin(['Admin', 'NV']);
$currentRole = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách nhân viên | Quản trị Admin</title>
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
        <li><a class="app-menu__item" href="./qldanhmuc.php"><i class='app-menu__icon bx bx-task'></i><span
              class="app-menu__label">Quản lý Danh Mục</span></a></li>
      <?php endif; ?>
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
    <div class="row">
      <div class="col-md-12">
        <div class="app-title">
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><b>Bảng điều khiển</b></a></li>
          </ul>
          <div id="clock"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <!--Left-->
      <div class="col-md-12 col-lg-6">
        <div class="row">
          <!----------------------------------------- tong khach hang --------------------------------->

          <?php
          include "connect.php";
          $query = "SELECT COUNT(*) AS total_customers FROM khachhang";
          $result = $conn->query($query);

          if ($result) {
            $row = $result->fetch_assoc();
            $totalCustomers = $row['total_customers'];
          } else {
            $totalCustomers = 0;
          }

          $conn->close();
          ?>
          <div class="col-md-6">
            <div class="widget-small primary coloured-icon">
              <i class='icon bx bxs-user-account fa-3x'></i>
              <div class="info">
                <h4>Tổng khách hàng</h4>
                <p><b><?php echo number_format($totalCustomers); ?> khách hàng</b></p>
                <p class="info-tong">Tổng số khách hàng được quản lý.</p>
              </div>
            </div>
          </div>

          <!----------------------------------------- tong san pham ----------------------------->
          <?php
          include "connect.php";
          $query = "SELECT COUNT(*) AS total_products FROM sanpham";
          $result = $conn->query($query);

          if ($result) {
            $row = $result->fetch_assoc();
            $total_products = $row['total_products'];
          } else {
            $total_products = 0;
          }
          ?>

          <div class="col-md-6">
            <div class="widget-small info coloured-icon">
              <i class='icon bx bxs-data fa-3x'></i>
              <div class="info">
                <h4>Tổng sản phẩm</h4>
                <p><b><?php echo number_format($total_products); ?> sản phẩm</b></p>
                <p class="info-tong">Tổng số sản phẩm được quản lý.</p>
              </div>
            </div>
          </div>
          <!----------------------------------- tong don hang ----------------------------->
          <?php
          include 'connect.php';

          $currentMonth = date('m');
          $currentYear = date('Y');

          $sql = "SELECT COUNT(*) AS total_orders 
                  FROM donhang 
                  WHERE MONTH(ngay_ban) = ? AND YEAR(ngay_ban) = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ii", $currentMonth, $currentYear);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result && $row = $result->fetch_assoc()) {
            $totalOrders = $row['total_orders'];
          } else {
            $totalOrders = 0;
          }
          ?>
          <div class="col-md-6">
            <div class="widget-small warning coloured-icon">
              <i class='icon bx bxs-shopping-bags fa-3x'></i>
              <div class="info">
                <h4>Tổng đơn hàng</h4>
                <p><b><?php echo number_format($totalOrders); ?> đơn hàng</b></p>
                <p class="info-tong">Tổng số hóa đơn bán hàng trong tháng.</p>
              </div>
            </div>
          </div>

          <!--------------------------- thong ke san pham sap het ---------------------->
          <?php
          include "connect.php";

          // nguong het hang
          $threshold = 5;
          $query = "SELECT COUNT(*) AS low_stock_products FROM sanpham WHERE SoLuong < $threshold";
          $result = $conn->query($query);

          if ($result) {
            $row = $result->fetch_assoc();
            $low_stock_products = $row['low_stock_products'];
          } else {
            $low_stock_products = 0;
          }
          ?>

          <div class="col-md-6">
            <div class="widget-small danger coloured-icon">
              <i class='icon bx bxs-error-alt fa-3x'></i>
              <div class="info">
                <h4>Sắp hết hàng</h4>
                <p><b><?php echo number_format($low_stock_products); ?> sản phẩm</b></p>
                <p class="info-tong">Số sản phẩm cảnh báo hết cần nhập thêm.</p>
              </div>
            </div>
          </div>
          <!-------------------------------------------- tinh trang don hang ---------------------------------->
          <!-- <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Tình trạng đơn hàng</h3>
              <div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID đơn hàng</th>
                      <th>Tên khách hàng</th>
                      <th>Tổng tiền</th>
                      <th>Trạng thái</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>AL3947</td>
                      <td>Phạm Thị Ngọc</td>
                      <td>
                        19.770.000 đ
                      </td>
                      <td><span class="badge bg-info">Chờ xử lý</span></td>
                    </tr>
                    <tr>
                      <td>ER3835</td>
                      <td>Nguyễn Thị Mỹ Yến</td>
                      <td>
                        16.770.000 đ	
                      </td>
                      <td><span class="badge bg-warning">Đang vận chuyển</span></td>
                    </tr>
                    <tr>
                      <td>MD0837</td>
                      <td>Triệu Thanh Phú</td>
                      <td>
                        9.400.000 đ	
                      </td>
                      <td><span class="badge bg-success">Đã hoàn thành</span></td>
                    </tr>
                    <tr>
                      <td>MT9835</td>
                      <td>Đặng Hoàng Phúc	</td>
                      <td>
                        40.650.000 đ	
                      </td>
                      <td><span class="badge bg-danger">Đã hủy	</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              / div trống-->
          <!-- </div>
           </div>
            / col-12 -->
          <!--------------------------------------------------- khach hang moi ----------------------------------->
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Sản phẩm bán chạy nhất</h3>
              <div>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Mã sản phẩm</th>
                      <th>Tên sản phẩm</th>
                      <th>Số lượng bán</th>
                      <th>Doanh thu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include 'connect.php';
                    $sql = "SELECT p.MaSP, p.TenSP, SUM(cthd.SoLuong) AS so_luong_ban, SUM(cthd.SoLuong * cthd.GiaBan) AS doanh_thu
                                        FROM chitiethoadon cthd
                                        JOIN sanpham p ON cthd.MaSP = p.MaSP
                                        GROUP BY p.MaSP, p.TenSP
                                        ORDER BY doanh_thu DESC
                                        LIMIT 10";

                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>#{$row['MaSP']}</td>";
                        echo "<td>{$row['TenSP']}</td>";
                        echo "<td>{$row['so_luong_ban']}</td>";
                        echo "<td>" . number_format($row['doanh_thu'], 0, ',', '.') . " VNĐ</td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- / col-12 -->
        </div>
      </div>
      <!--END left-->
      <!--Right-->

      <!------------------------------------------- thong ke san pham ------------------------------------>
    <!------------------------------------------- thong ke san pham ------------------------------------>
<?php
include "connect.php";

$query = "
    SELECT sp.MaSP, sp.TenSP, SUM(cthd.SoLuong) AS soLuongBanDuoc
    FROM chitiethoadon cthd
    INNER JOIN sanpham sp ON cthd.MaSP = sp.MaSP
    GROUP BY sp.MaSP, sp.TenSP
";

$result = $conn->query($query);
$labels = [];
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['TenSP'];  
        $data[] = $row['soLuongBanDuoc']; 
    }
} else {
    echo "Không có dữ liệu!";
}

$conn->close();
?>
<div class="col-md-12 col-lg-6">
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Thống kê sản phẩm</h3>
              
              <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
              </div>
            </div>
          </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('lineChartDemo').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',  
        data: {
            labels: <?php echo json_encode($labels); ?>, 
            datasets: [{
                label: 'Số lượng bán được',
                data: <?php echo json_encode($data); ?>,  
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
               
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return 'Số lượng: ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>
<!-------------------------------------------- thong ke doanh thu -------------------------------->
<?php
include 'connect.php';

$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '2024-11-15';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '2024-11-20';
$sql = "SELECT DATE(ngay_ban) AS ngay_ban, SUM(tong_tien) AS doanh_thu
        FROM donhang
        WHERE ngay_ban BETWEEN '$start_date' AND '$end_date'
        GROUP BY DATE(ngay_ban)
        ORDER BY ngay_ban";

$result = $conn->query($sql);
$dates = [];
$revenue = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dates[] = $row['ngay_ban'];
        $revenue[] = $row['doanh_thu'];
    }
} else {
    $dates[] = 'Không có dữ liệu';
    $revenue[] = 0;
}

$conn->close();
?>
<div class="col-md-12">
    <div class="tile">
        <h3 class="tile-title">Thống kê doanh thu</h3>
<form method="GET" action="">
            <label for="start_date">Từ ngày:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo $start_date; ?>" required>
  
            <label for="end_date">Đến ngày:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo $end_date; ?>" required>

            <button type="submit" class="btn btn-primary">Thống kê</button>
        </form>
        <div class="embed-responsive embed-responsive-16by9">
            <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var dates = <?php echo json_encode($dates); ?>;
    var revenue = <?php echo json_encode($revenue); ?>;

    var ctx = document.getElementById('barChartDemo').getContext('2d');
    var barChartDemo = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dates,  
            datasets: [{
                label: 'Doanh thu (VNĐ)',  
                data: revenue, 
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString() + ' VNĐ';  
                        }
                    }
                }
            }
        }
    });
</script>
<style>
            #filterForm {
              display: flex;
              flex-wrap: wrap;
              align-items: center;
              gap: 10px;
              margin-bottom: 20px;
            }

            #filterForm label {
              font-size: 16px;
              font-weight: bold;
              margin-right: 5px;
            }

            #filterForm input[type="date"] {
              padding: 5px 10px;
              border: 1px solid #ccc;
              border-radius: 5px;
              font-size: 14px;
            }

            #filterForm button {
              padding: 8px 15px;
              background-color: #ffc107;
              /* Màu cam */
              color: #212529;
              /* Màu chữ đậm */
              border: none;
              border-radius: 5px;
              font-size: 16px;
              font-weight: bold;
              cursor: pointer;
              transition: background-color 0.3s, transform 0.2s;
            }

            #filterForm button:hover {
              background-color: #e0a800;
              /* Màu cam đậm hơn khi hover */
              transform: scale(1.05);
              /* Hiệu ứng phóng to nhẹ */
            }
          </style>
          <!------ thong ke doanh thu ------>
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <script>
            var labels = <?php echo json_encode($labels); ?>;
            var data = <?php echo json_encode($data); ?>;

            var ctx = document.getElementById('barChartDemo').getContext('2d');
            var barChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: labels,
                    datasets: [{
                      label: 'Doanh thu (VNĐ)',
                      data: data,
                      backgroundColor: '#4e73df',
                      borderColor: '#4e73df',
                      borderWidth: 1
                    }]
                  },
                  options: {
                    responsive: true,
                    scales: {
                      y: {
                        beginAtZero: true,
                        ticks: {
                          callback: function(value) {
                            return value.toLocaleString();
                          }
                        }
                      }
                    }
                  }
                }
              )
          </script>

          <!-------------------------------------------- thong ke doanh thu -------------------------------->
          <?php
          include 'connect.php';

          $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '2024-11-15';
          $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '2024-11-20';
          $sql = "SELECT DATE(ngay_ban) AS ngay_ban, SUM(tong_tien) AS doanh_thu
        FROM donhang
        WHERE ngay_ban BETWEEN '$start_date' AND '$end_date'
        GROUP BY DATE(ngay_ban)
        ORDER BY ngay_ban";

          $result = $conn->query($sql);
          $dates = [];
          $revenue = [];

          if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $dates[] = $row['ngay_ban'];
              $revenue[] = $row['doanh_thu'];
            }
          } else {
            $dates[] = 'Không có dữ liệu';
            $revenue[] = 0;
          }

          $conn->close();
          ?>

          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
          <main>
        </div>
        <div class="text-center" style="font-size: 13px">
          <p><b>Copyright
              <script type="text/javascript">

              </script> Phần mềm quản lý bán hàng
            </b></p>
        </div>

  </main>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/plugins/pace.min.js"></script>
  <!-- <script type="text/javascript" src="js/plugins/chart.js"></script> -->


  <?php

  if (!isset($_SESSION['username'])) {
    //header("Location: ../index.php");   
    exit();
  }
  ?>



</body>

</html>