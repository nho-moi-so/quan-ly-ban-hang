<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
  <style>
   body {
            font-family: Arial, sans-serif;
            max-width: 1500px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-container {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        .success-message {
            color: #4CAF50;
            margin-top: 10px;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            display: none;
        }
 </style>


</head>
<body>
    <!-- Navbar-->
  <header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
      aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


      <!-- User Menu-->
      <li><a class="app-nav__item" href="/index.html"><i class='bx bx-log-out bx-rotate-180'></i> </a>

      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../images/hay.jpg" width="50px"
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
              class="app-menu__label"><?php if (in_array($currentRole, ['Admin'])): ?>
        <li><a class="app-menu__item" href="./table-data-oder.php"><i class='app-menu__icon bx bx-task'></i><span
              class="app-menu__label">Quản lý Hóa Đơn</span></a></li>
      <?php endif; ?>
      <?php if (in_array($currentRole, ['Admin'])): ?>
        <li><a class="app-menu__item" href="./table-data-danh-muc.php"><i class='app-menu__icon bx bx-task'></i><span
              class="app-menu__label">Quản lý Danh Mục</span></a></li>
      <?php endif; ?></span></a></li>
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
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item active"><a href="#"><b>Lập hóa đơn</b></a></li>
        </ul>
        <div id="clock"></div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row element-button">
                    <div class="col-sm-2">
                        <a class="btn btn-add btn-sm" href="./invoice-list.php" title="Thêm"><i class="fas fa-plus"></i>
                         Danh sách hóa đơn</a>
                    </div>
                    <div class="col-sm-2">
                        <a class="btn btn-delete btn-sm nhap-tu-file" type="button" title="Nhập" onclick="myFunction(this)"><i
                        class="fas fa-file-upload"></i> Tải từ file</a>
                    </div>
  
                    <div class="col-sm-2">
                        <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i
                         class="fas fa-print"></i> In dữ liệu</a>
                    </div>
                    <div class="col-sm-2">
                        <a class="btn btn-delete btn-sm print-file js-textareacopybtn" type="button" title="Sao chép"><i
                        class="fas fa-copy"></i> Sao chép</a>
                    </div>
  
                    <div class="col-sm-2">
                        <a class="btn btn-excel btn-sm" href="" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
                    </div>
                    <div class="col-sm-2">
                        <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i
                        class="fas fa-file-pdf"></i> Xuất PDF</a>
                    </div>
                    <div class="col-sm-2">
                        <a class="btn btn-delete btn-sm" type="button" title="Xóa" onclick="myFunction(this)"><i
                        class="fas fa-trash-alt"></i> Xóa tất cả </a>
                    </div>                   
              </div>

              <div class="form-container">
                 <h2>Form Lập Hóa Đơn</h2>
                    <form id="invoiceForm">
                        <div class="form-group">
                            <label for="invoiceId">Mã Hóa Đơn:</label>
                            <input type="text" id="invoiceId" required>
                        </div>
        
                         <div class="form-group">
                            <label for="employeeId">Mã Nhân Viên:</label>
                            <input type="text" id="employeeId" required>
                        </div>
        
                        <div class="form-group">
                            <label for="dateTime">Ngày Giờ Bán:</label>
                            <input type="datetime-local" id="dateTime" required>
                        </div>
        
                        <div class="form-group">
                            <label for="paymentMethod">Phương Thức Thanh Toán:</label>
                            <select id="paymentMethod" required>
                                <option value="">Chọn phương thức thanh toán</option>
                                <option value="cash">Tiền mặt</option>
                                <option value="card">Thẻ ngân hàng</option>
                                <option value="transfer">Chuyển khoản</option>
                                <option value="momo">Ví MoMo</option>
                            </select>
                        </div>
        
                        <div class="form-group">
                            <label for="customerId">Mã Khách Hàng:</label>
                            <input type="text" id="customerId" required>
                        </div>
        
                         <div class="form-group">
                            <label for="totalAmount">Tổng Tiền:</label>
                            <input type="number" id="totalAmount" min="0" required>
                        </div>
                         <button type="submit">Lập Hóa Đơn</button>
                  </form>
                        <div id="successMessage" class="success-message">
                        Hóa đơn đã được lập thành công!
                        </div>
                </div>   
            </div>           
          </div>
        </div>
      </div>
      <script>
        // Khởi tạo mảng lưu trữ hóa đơn
        let invoices = JSON.parse(localStorage.getItem('invoices')) || [];

        // Xử lý sự kiện submit form
        document.getElementById('invoiceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Lấy giá trị từ form
            const invoiceData = {
                invoiceId: document.getElementById('invoiceId').value,
                employeeId: document.getElementById('employeeId').value,
                dateTime: document.getElementById('dateTime').value,
                paymentMethod: document.getElementById('paymentMethod').value,
                customerId: document.getElementById('customerId').value,
                totalAmount: document.getElementById('totalAmount').value
            };

            // Kiểm tra dữ liệu
            if (!validateForm(invoiceData)) {
                return;
            }

            // Thêm hóa đơn vào mảng và lưu vào localStorage
            let invoices = JSON.parse(localStorage.getItem('invoices')) || [];
            invoices.push(invoiceData);
            localStorage.setItem('invoices', JSON.stringify(invoices));
            
            // Lưu hóa đơn hiện tại để hiển thị
            localStorage.setItem('currentInvoice', JSON.stringify(invoiceData));

            // Hiển thị thông báo thành công
            showSuccessMessage();

            // Mở trang hiển thị hóa đơn
            /*window.open('display-invoice.html', '_blank');*/

            // Reset form
            this.reset();
            setCurrentDateTime();
        });

        // Hàm kiểm tra dữ liệu
        function validateForm(data) {
            if (data.invoiceId.length < 3) {
                alert('Mã hóa đơn phải có ít nhất 3 ký tự!');
                return false;
            }
            if (data.employeeId.length < 2) {
                alert('Mã nhân viên không hợp lệ!');
                return false;
            }
            const inputDate = new Date(data.dateTime);
            const currentDate = new Date();
            if (inputDate > currentDate) {
                alert('Ngày giờ bán không được lớn hơn thời gian hiện tại!');
                return false;
            }
            if (!data.paymentMethod) {
                alert('Vui lòng chọn phương thức thanh toán!');
                return false;
            }
            if (data.customerId.length < 2) {
                alert('Mã khách hàng không hợp lệ!');
                return false;
            }
            if (data.totalAmount <= 0) {
                alert('Tổng tiền phải lớn hơn 0!');
                return false;
            }
            return true;
        }

        // Hàm hiển thị thông báo thành công
        function showSuccessMessage() {
            const message = document.getElementById('successMessage');
            message.style.display = 'block';
            setTimeout(() => {
                message.style.display = 'none';
            }, 3000);
        }

        // Hàm set ngày giờ hiện tại
        function setCurrentDateTime() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            
            const currentDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
            document.getElementById('dateTime').value = currentDateTime;
        }

        // Khởi tạo khi tải trang
        document.addEventListener('DOMContentLoaded', function() {
            setCurrentDateTime();
        });
    </script>
    </main>
</body>
</html>