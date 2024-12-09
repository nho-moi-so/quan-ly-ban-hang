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
            max-width: 1200px;
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

        .btn-add {
            background-color: #f5f5f5;/*#4CAF50;*/
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
        }

        .btn-add:hover {
            background-color: #f5f5f5;/*#45a049;*/
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: white;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: /*#4CAF50;*/ #f5f5f5;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-edit {
            background-color: #2196F3;
            color: white;
        }

        .btn-edit:hover {
            background-color: #1976D2;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }

        .btn-delete:hover {
            background-color: #d32f2f;
        }

        .points-input {
            width: 80px;
            padding: 6px;
            border: 1px solid #ddd;
            border-radius: 4px;
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
                        <a class="btn btn-add btn-sm" href="./customer-form.php" title="Thêm"><i class="fas fa-plus"></i>
                         Tạo mới khách hàng</a>
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
                        <h2 class="section-title">Danh sách khách hàng</h2>
                        <a href="customer-form.html" class="btn-add">+ Thêm khách hàng</a>
                     </div> -->
                
                    <div class="search-box">
                        <input type="text" id="searchCustomer" placeholder="Tìm kiếm khách hàng...">
                    </div>
        
                    <div class="table-container">
                        <table>
                            <thead>
                            <tr>
                                <th>Mã KH</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Điểm tích lũy</th>
                                <th>Thao tác</th>
                            </tr>
                            </thead>
                            <tbody id="customerTableBody"></tbody>
                        </table>
                    </div>
                </div>

            </div>           
          </div>
        </div>
      </div>
      <script src="customer-data.js"></script>
      <script>
          const tableBody = document.getElementById('customerTableBody');
          const searchInput = document.getElementById('searchCustomer');
  
          function displayCustomers(customersToDisplay = getCustomers()) {
              tableBody.innerHTML = '';
              customersToDisplay.forEach(customer => {
                  const row = document.createElement('tr');
                  row.innerHTML = `
                      <td>${customer.id}</td>
                      <td>${customer.name}</td>
                      <td>${customer.phone}</td>
                      <td>
                          <input type="number" class="points-input" value="${customer.points}"
                              onchange="updatePoints(${customer.id}, this.value)">
                      </td>
                      <td class="action-buttons">
                          <a href="customer-form.php?id=${customer.id}" class="btn btn-edit">Sửa</a>
                          <button class="btn btn-delete" onclick="deleteCustomer(${customer.id})">Xóa</button>
                      </td>
                  `;
                  tableBody.appendChild(row);
              });
          }
  
          function deleteCustomer(id) {
              if (confirm('Bạn có chắc muốn xóa khách hàng này?')) {
                  removeCustomer(id);
                  displayCustomers();
              }
          }
  
          function updatePoints(id, newPoints) {
              updateCustomerPoints(id, parseInt(newPoints));
          }
  
          searchInput.addEventListener('input', function(e) {
              const searchTerm = e.target.value.toLowerCase();
              const filteredCustomers = getCustomers().filter(customer => 
                  customer.name.toLowerCase().includes(searchTerm) ||
                  customer.phone.includes(searchTerm) ||
                  customer.id.toString().includes(searchTerm)
              );
              displayCustomers(filteredCustomers);
          });
  
          // Hiển thị ban đầu
          displayCustomers();

          // dữ liệu khách hàng.js
let customers = [
    { id: 1, name: 'Nguyễn Văn A', phone: '0123456789', points: 100 },
    { id: 2, name: 'Trần Thị B', phone: '0987654321', points: 150 }
];

// Hàm nhận khách hàng 
function getCustomers() {
    return customers;
}

// Hàm nhận khách hàng theo ID
function getCustomerById(id) {
    return customers.find(c => c.id === id);
}

// Thêm khách hàng mới 
function addCustomer(customerData) {
    const newId = customers.length > 0 ? Math.max(...customers.map(c => c.id)) + 1 : 1;
    const newCustomer = {
        id: newId,
        ...customerData
    };
    customers.push(newCustomer);
    return newCustomer;
}

// Cập nhật khách hàng
function updateCustomer(updatedCustomer) {
    const index = customers.findIndex(c => c.id === updatedCustomer.id);
    if (index !== -1) {
        customers[index] = updatedCustomer;
        return true;
    }
    return false;
}

// Xóa khách hàng
function removeCustomer(id) {
    customers = customers.filter(c => c.id !== id);
}

// Cập nhật điểm 
function updateCustomerPoints(id, newPoints) {
    const customer = customers.find(c => c.id === id);
    if (customer) {
        customer.points = newPoints;
        return true;
    }
    return false;
}
      </script>
    </main>
</body>
</html>