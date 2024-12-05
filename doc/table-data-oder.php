<?php
require_once 'auth.php';
checkAdmin((['Admin', 'NV']));
$currentRole = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách đơn hàng | Quản trị Admin</title>
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

<!--------------------------------- danh sach don hang ------------------------------------------------>
<?php
include 'connect.php';

$sql = "SELECT donhang.*, khachhang.MaKH, khachhang.TenKH 
        FROM donhang 
        LEFT JOIN khachhang ON donhang.khach_hang = khachhang.MaKH";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0): ?>
<main class="app-content">
  <div class="app-title">
    <ul class="app-breadcrumb breadcrumb side">
      <li class="breadcrumb-item active"><a href="#"><b>Danh sách đơn hàng</b></a></li>
    </ul>
    <div id="clock"></div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="row element-button">
            <div class="col-sm-2">
              <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
            </div>
          </div>
          <table class="table table-hover table-bordered" id="table-data-order">
            <thead>
              <tr>
                
                <th>Mã đơn hàng</th>
                <th>Mã khách hàng</th>
                <th>Ngày bán</th>
                <th>Tổng tiền</th>
                <th>Tính năng</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                  
                  <td><?php echo isset($row['ma_don_hang']) ? $row['ma_don_hang'] : 'Không có dữ liệu'; ?></td>
                  <td><?php 
                    echo isset($row['MaKH']) && isset($row['TenKH']) ? $row['MaKH'] . '-' . $row['TenKH'] : 'Không có dữ liệu'; 
                  ?></td>
                  <td><?php echo isset($row['ngay_ban']) ? $row['ngay_ban'] : 'Không có dữ liệu'; ?></td>
                  <td><?php echo isset($row['tong_tien']) ? number_format($row['tong_tien'], 0, ',', '.').'VNĐ' : 'Không có dữ liệu'; ?></td>
                  <td>
                    <a href="#" class="btn btn-info" 
                       data-toggle="modal" data-target="#viewOrderModal"
                       data-id="<?php echo $row['id_don_hang']; ?>"
                       data-ma-don-hang="<?php echo $row['ma_don_hang']; ?>"
                       data-khach-hang="<?php echo $row['MaKH'] . '-' . $row['TenKH']; ?>" 
                       data-ngay-ban="<?php echo $row['ngay_ban']; ?>"
                       data-tong-tien="<?php echo number_format($row['tong_tien'], 0, ',', '.').'VNĐ'; ?>"
                       onclick="viewOrderDetails(this)">Xem đơn hàng</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<!-------------------------- MODAL XEM DON HANG --------------------------->

<div class="modal fade" id="viewOrderModal" tabindex="-1" role="dialog" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewOrderModalLabel">Chi tiết đơn hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Mã đơn hàng:</strong> <span id="order-id"></span></p>
        <p><strong>Mã khách hàng:</strong> <span id="customer-id"></span></p>
        <p><strong>Ngày bán:</strong> <span id="order-date"></span></p>
        <p><strong>Tổng tiền:</strong> <span id="total-amount"></span></p>

        <h5>Chi tiết các sản phẩm:</h5>
        <table class="table table-bordered" id="order-details-table">
          <thead>
            <tr>
              <th>Mã sản phẩm</th>
              <th>Tên sản phẩm</th>
              <th>Số lượng</th>
              <th>Đơn giá</th>
              <th>Tổng</th>
            </tr>
          </thead>
          <tbody id="order-details-body">
          </tbody>
        </table>
        
      </div>
      <div class="modal-footer">
      <button class="btn btn-primary" onclick="printOrderDetails()">In chi tiết đơn hàng</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

<?php else: ?>
    <p>Không có dữ liệu đơn hàng nào.</p>
<?php endif; ?>
<!----------------- MODAL XEM DON HANG --------------------->

  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="src/jquery.table2excel.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
  <script>
    // Lưu dữ liệu từ form vào localStorage
const orderForm = document.querySelector('#orderForm');
orderForm.addEventListener('submit', (event) => {
  event.preventDefault();

  const orderData = {
    orderNumber: document.querySelector('#orderNumber').value,
    customerId: document.querySelector('#customerId').value,
    employeeId: document.querySelector('#employeeId').value,
    orderDate: document.querySelector('#orderDate').value,
    paymentMethod: document.querySelector('#paymentMethod').value,
    status: document.querySelector('#status').value
  };

  // Lưu dữ liệu vào localStorage
  const orders = JSON.parse(localStorage.getItem('orders')) || [];
  orders.push(orderData);
  localStorage.setItem('orders', JSON.stringify(orders));

  // Hiển thị danh sách đơn hàng
  renderOrderList();

  // Reset form
  orderForm.reset();
});

// Hiển thị danh sách đơn hàng
function renderOrderList() {
  const orderList = document.querySelector('#orderList');
  orderList.innerHTML = '';

  const orders = JSON.parse(localStorage.getItem('orders')) || [];

  orders.forEach((order, index) => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${order.orderNumber}</td>
      <td>${order.customerId}</td>
      <td>${order.employeeId}</td>
      <td>${order.orderDate}</td>
      <td>${order.paymentMethod}</td>
      <td>${order.status}</td>
      <td>
        <button class="btn btn-primary btn-sm edit-order" data-index="${index}">Sửa</button>
        <button class="btn btn-danger btn-sm delete-order" data-index="${index}">Xóa</button>
      </td>
    `;
    orderList.appendChild(tr);
  });

  // Thêm sự kiện sửa và xóa
  const editButtons = document.querySelectorAll('.edit-order');
  editButtons.forEach((button) => {
    button.addEventListener('click', editOrder);
  });

  const deleteButtons = document.querySelectorAll('.delete-order');
  deleteButtons.forEach((button) => {
    button.addEventListener('click', deleteOrder);
  });
}

// Sửa đơn hàng
function editOrder(event) {
  const index = event.target.dataset.index;
  const orders = JSON.parse(localStorage.getItem('orders'));
  const order = orders[index];

  document.querySelector('#orderNumber').value = order.orderNumber;
  document.querySelector('#customerId').value = order.customerId;
  document.querySelector('#employeeId').value = order.employeeId;
  document.querySelector('#orderDate').value = order.orderDate;
  document.querySelector('#paymentMethod').value = order.paymentMethod;
  document.querySelector('#status').value = order.status;
}

// Xóa đơn hàng
function deleteOrder(event) {
  const index = event.target.dataset.index;
  const orders = JSON.parse(localStorage.getItem('orders'));
  orders.splice(index, 1);
  localStorage.setItem('orders', JSON.stringify(orders));
  renderOrderList();
}

// Hiển thị danh sách đơn hàng khi trang được tải
renderOrderList();

// Hiển thị ngày giờ bán hàng
const orderDateInput = document.querySelector('#orderDate');

function updateOrderDate() {
  const currentDate = new Date();
  const formattedDate = currentDate.toLocaleString();
  orderDateInput.value = formattedDate;
}

updateOrderDate();
setInterval(updateOrderDate, 1000); // Cập nhật mỗi giây
  </script>




<script>
function viewOrderDetails(element) {
  var orderId = $(element).data('id');
  var maDonHang = $(element).data('ma-don-hang');
  var khachHang = $(element).data('khach-hang');
  var ngayBan = $(element).data('ngay-ban');
  var tongTien = $(element).data('tong-tien');

  // Cập nhật thông tin đơn hàng trong modal
  $('#order-id').text(maDonHang);
  $('#customer-id').text(khachHang);
  $('#order-date').text(ngayBan);
  $('#total-amount').text(tongTien);

  // Lấy chi tiết sản phẩm của đơn hàng từ cơ sở dữ liệu
  $.ajax({
    url: 'get_order_details.php', // Tạo một file PHP để lấy chi tiết đơn hàng từ DB
    method: 'GET',
    data: { order_id: orderId },
    success: function(response) {
      var details = JSON.parse(response);
      var detailsTableBody = $('#order-details-body');
      detailsTableBody.empty(); // Xóa dữ liệu cũ

      details.forEach(function(item) {
        detailsTableBody.append(
          '<tr>' +
            '<td>' + item.MaSP + '</td>' +
            '<td>' + item.TenSP + '</td>' +
            '<td>' + item.SoLuong + '</td>' +
            '<td>' + item.GiaBan + '</td>' +
            '<td>' + (item.SoLuong * item.GiaBan) + '</td>' +
          '</tr>'
        );
      });
    }
  });
}
</script>


<script>
  // Hàm in dữ liệu
function printTable() {
  var table = document.getElementById('table-data-order'); // Lấy bảng dữ liệu cần in
  var printWindow = window.open('', '', 'height=500, width=800'); // Mở cửa sổ mới
  printWindow.document.write('<html><head><title>In dữ liệu đơn hàng</title>'); // Thêm tiêu đề cho trang in
  printWindow.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">'); // Thêm CSS cho bảng
  printWindow.document.write('</head><body>');
  printWindow.document.write(table.outerHTML); // Thêm nội dung bảng vào cửa sổ in
  printWindow.document.write('</body></html>');
  printWindow.document.close(); // Đóng cửa sổ document để tải xong
  printWindow.print(); // Thực hiện in
}
</script>

<script>
  // Hàm in chi tiết đơn hàng
function printOrderDetails() {
  var modalContent = document.querySelector('#viewOrderModal .modal-body'); // Lấy phần nội dung của modal
  var printWindow = window.open('', '', 'height=500, width=800'); // Mở cửa sổ mới
  printWindow.document.write('<html><head><title>In chi tiết đơn hàng</title>'); // Thêm tiêu đề cho trang in
  printWindow.document.write('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">'); // Thêm CSS cho bảng
  printWindow.document.write('</head><body>');
  printWindow.document.write(modalContent.outerHTML); // Thêm nội dung modal vào cửa sổ in
  printWindow.document.write('</body></html>');
  printWindow.document.close(); // Đóng cửa sổ document để tải xong
  printWindow.print(); // Thực hiện in
}

</script>
</body>
</html>