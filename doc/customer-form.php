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
            max-width: 1900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            color: #333;
            margin: 0;
            padding-bottom: 10px;
        }

        .btn-back {
            color: #666;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #f5f5f5;/*#4CAF50;*/
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.2);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #f5f5f5/*#4CAF50;*/;
            color: white;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #f5f5f5;/*#45a049;*/
        }

        .error-message {
            color: #f44336;
            font-size: 14px;
            margin-top: 5px;
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
        <li><a class="app-menu__item" href="./table-data-danh-muc.php"><i class='app-menu__icon bx bx-task'></i><span
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
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item active"><a href="#"><b>Danh sách đơn hàng/Tạo mới khách hàng</b></a></li>
        </ul>
        <div id="clock"></div>
      </div>
      <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row element-button">
                            <div class="col-sm-2">
                                <a class="btn btn-add btn-sm" href="./customer-list.php" title="Thêm"><i class="fas fa-plus"></i>
                                Danh sách khách hàng</a>
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

                        <div class="container">
                            <!-- <div class="header">
                                <h2 class="section-title" id="formTitle">Thêm khách hàng mới</h2>
                                <a href="customer-list.html" class="btn-back">← Quay lại danh sách</a>
                            </div> -->
        
                          <form id="customerForm">
                                <input type="hidden" id="customerId">
                                <div class="form-group">
                                    <label for="name">Họ tên:</label>
                                    <input type="text" id="name" required>
                                    <div class="error-message" id="nameError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Số điện thoại:</label>
                                    <input type="tel" id="phone" required>
                                <div class="error-message" id="phoneError"></div>
                                </div>
                                <div class="form-group">
                                    <label for="points">Điểm tích lũy:</label>
                                    <input type="number" id="points" required>
                                <div class="error-message" id="pointsError"></div>
                                </div>
                                <button type="submit" id="submitBtn" class="btn btn-primary">Thêm khách hàng</button>
                            </form>
                        </div>
                 </div>           
             </div>
         </div>
      </div>
      <script src="customer-data.js"></script>
      <script>
          const form = document.getElementById('customerForm');
          const formTitle = document.getElementById('formTitle');
          const submitBtn = document.getElementById('submitBtn');
          
          // Kiểm tra chỉnh sửa khách hàng 
          const urlParams = new URLSearchParams(window.location.search);
          const editId = urlParams.get('id');
  
          if (editId) {
              const customer = getCustomerById(parseInt(editId));
              if (customer) {
                  document.getElementById('customerId').value = customer.id;
                  document.getElementById('name').value = customer.name;
                  document.getElementById('phone').value = customer.phone;
                  document.getElementById('points').value = customer.points;
                  formTitle.textContent = 'Sửa thông tin khách hàng';
                  submitBtn.textContent = 'Cập nhật';
              }
          }
  
          form.onsubmit = function(e) {
              e.preventDefault();
              const name = document.getElementById('name').value;
              const phone = document.getElementById('phone').value;
              const points = document.getElementById('points').value;
              const customerId = document.getElementById('customerId').value;
  
              const customerData = {
                  name,
                  phone,
                  points: parseInt(points)
              };
  
              if (customerId) {
                  // Cập nhật khách hàng 
                  updateCustomer({
                      id: parseInt(customerId),
                      ...customerData
                  });
              } else {
                  // Thêm khách hàng mới 
                  addCustomer(customerData);
              }
  
              //chuyển trang trở lại danh sách khách hàng 
              window.location.href = 'customer-list.php';
          };
          
      </script>
      
  </main>
</body>
</html>