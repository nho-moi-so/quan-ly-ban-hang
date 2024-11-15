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
        <p class="app-sidebar__user-name"><b>Võ Trường</b></p>
        <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
      </div>
    </div>
    <hr>
    <ul class="app-menu">
      <li><a class="app-menu__item haha" href="phan-mem-ban-hang.html"><i class='app-menu__icon bx bx-cart-alt'></i>
          <span class="app-menu__label">POS Bán Hàng</span></a></li>
      <li><a class="app-menu__item " href="index.php"><i class='app-menu__icon bx bx-tachometer'></i><span
            class="app-menu__label">Bảng điều khiển</span></a></li>
      <li><a class="app-menu__item " href="table-data-table.php"><i class='app-menu__icon bx bx-id-card'></i>
          <span class="app-menu__label">Quản lý nhân viên</span></a></li>
      <li><a class="app-menu__item" href="./table-data-khachhang.php"><i class='app-menu__icon bx bx-user-voice'></i><span
            class="app-menu__label">Quản lý khách hàng</span></a></li>
      <li><a class="app-menu__item" href="./table-data-product.php"><i
            class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
      </li>
      <li><a class="app-menu__item active" href="table-data-oder.php"><i class='app-menu__icon bx bx-task'></i><span
            class="app-menu__label">Quản lý đơn hàng</span></a></li>
      <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Cài
            đặt hệ thống</span></a></li>
    </ul>
  </aside>
    <main class="app-content">
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item">Danh sách đơn hàng</li>
          <li class="breadcrumb-item"><a href="#">Thêm đơn hàng</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Tạo mới đơn hàng</h3>
            <div class="tile-body">
              <form class="row">
                <div class="form-group  col-md-4">
                  <label class="control-label"> ( Nếu không nhập sẽ tự động phát sinh )</label>
                  <input class="form-control" type="text">
                </div>
                <div class="form-group  col-md-4">
                  <label class="control-label">Mã hóa đơn</label>
                  <input class="form-control" type="text" >
                </div>
                <div class="form-group  col-md-4">
                  <label class="control-label">Mã Khách hàng</label>
                  <input class="form-control" type="customerId">
                </div> 
                <div class="form-group  col-md-4">
                  <label class="control-label">Mã nhân viên </label>
                  <input class="form-control" type="employeeId" >
                </div>               
                <div class="form-group  col-md-4">
                  <label class="control-label">Ngày giờ bán</label>
                  <input class="form-control" type="datetime" >
                </div>              
                <div class="form-group  col-md-4">
                  <label class="control-label">Mã Khách hàng</label>
                  <input class="form-control" type="customerId">
                </div> 
                <div class="form-group col-md-4">
                  <label for="paymentMethod" class="control-label">Phương Thức Thanh Toán:</label>
                  <select class="form-control" id="paymentMethod">
                      <option value="">Chọn phương thức thanh toán</option>
                      <option value="cash">Tiền mặt</option>
                      <option value="card">Thẻ ngân hàng</option>
                      <option value="transfer">Chuyển khoản</option>
                      <option value="momo">Ví MoMo</option>
                  </select>
              </div>
                <div class="form-group col-md-4">
                  <label for="exampleSelect1" class="control-label">Tình trạng</label>
                  <select class="form-control" id="exampleSelect1">
                    <option>-- Chọn tình trạng --</option>
                    <option>Đã xử lý</option>
                    <option>Đang chờ</option>
                    <option>Đã hủy</option>
                  </select>
                </div>

          </div>
          <button class="btn btn-save" type="button">Lưu lại</button>
          <a class="btn btn-cancel" href="/doc/table-data-oder.php">Hủy bỏ</a>
        </div>
    </main>
   <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
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
  </body>
</html>