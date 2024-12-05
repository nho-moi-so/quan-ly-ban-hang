<?php
session_start();
require_once 'auth.php';
checkLogin();
checkAdmin(['Admin']);
$currentRole = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
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

    <title>Quản lý Danh mục</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            margin: 0 auto;
            max-width: 800px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #27C46B;
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
        .btn-edit {
            background-color: #2196F3;
        }
        .btn-delete {
            background-color: #f44336;
        }
        table {
            width: 170%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 5px;
            width: 70%;
            max-width: 600px;
        }
        .close {
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .category-row:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body onload="time()" class="app sidebar-mini rtl">
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

 <div class="container">
    <div class="row">
        <div class="col-md-12">
          <div class="app-title">
            <ul class="app-breadcrumb breadcrumb">
              <li class="breadcrumb-item"><a href="#"><b>Quản Lý Danh Mục</b></a></li>
            </ul>
            <div id="clock"></div>
          </div>
        </div>
    </div>  
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="row element-button">
                        <div class="col-sm-2">
                            <a class="btn btn-add btn-sm" href="xuliqldanhmuc.php" title="Thêm"><i class="fas fa-plus"></i>
                                Tạo mới danh mục</a>
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
                </div>
            </div>
        </div>
    </div>
    

    <div class="container">
     <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">

        <!-- Phần Tìm kiếm -->
        <div class="form-group">
            <input type="text" id="searchCategory" placeholder="Tìm kiếm danh mục..." 
                style="padding: 8px; width: 200px; margin-right: 10px;">
        </div>

        <!-- Nút thêm danh mục -->
        <!-- <button onclick="showAddCategoryModal()">Thêm Danh mục</button> -->

        <!-- Bảng danh mục -->
        <table>
            <thead>
                <tr>
                    <th>Mã Danh Mục</th>
                    <th>Mã Sản Phẩm</th>
                    <th>Tên Danh Mục</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="categoryList">
                <!-- Danh sách danh mục -->
            </tbody>
        </table>
    </div>

    <!-- Modal Thêm/Sửa Danh mục -->
    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCategoryModal()">&times;</span>
            <h2 id="categoryModalTitle">Thêm Danh mục</h2>
            <form id="categoryForm">
                <input type="hidden" id="editCategoryId">
                <div class="form-group">
                    <label for="maDanhMuc">Mã Danh Mục:</label>
                    <input type="text" id="maDanhMuc" required>
                </div>
                <div class="form-group">
                    <label for="maSanPham">Mã Sản Phẩm:</label>
                    <input type="text" id="maSanPham" required>
                </div>
                <div class="form-group">
                    <label for="tenDanhMuc">Tên Danh Mục:</label>
                    <input type="text" id="tenDanhMuc" required>
                </div>
                <div class="form-group">
                    <label for="moTaDanhMuc">Mô tả Danh mục:</label>
                    <textarea id="moTaDanhMuc" rows="4"></textarea>
                </div>
                <button type="submit">Lưu</button>
            </form>
        </div>
    </div>
</div>
    <script>
        // Dữ liệu mẫu
        let categories = [
            { id: '01', maDanhMuc: '01', maSanPham: 'SP001', tenDanhMuc: 'Gia Vị', moTaDanhMuc: 'Các loại gia vị nấu ăn' },
            { id: '02', maDanhMuc: '02', maSanPham: 'SP002', tenDanhMuc: 'Bánh,Kẹo', moTaDanhMuc: 'Các loại bánh kẹo' },
            { id: '03', maDanhMuc: '03', maSanPham: 'SP003', tenDanhMuc: 'Mì, Phở, Cháo', moTaDanhMuc: 'Thực phẩm ăn liền' },
            { id: '04', maDanhMuc: '04', maSanPham: 'SP004', tenDanhMuc: 'Dầu Gội', moTaDanhMuc: '' },
            { id: '05', maDanhMuc: '05', maSanPham: 'SP005', tenDanhMuc: 'Sữa Đóng Hộp', moTaDanhMuc: 'Thực phẩm dinh dưỡng' },
            { id: '06', maDanhMuc: '06', maSanPham: 'SP006', tenDanhMuc: 'Nước Đóng Chai', moTaDanhMuc: 'Các loại thức uống ' }
        ];

        // Hiển thị danh sách danh mục
        function displayCategories() {
            const categoryList = document.getElementById('categoryList');
            categoryList.innerHTML = '';
            
            categories.forEach(category => {
                const row = document.createElement('tr');
                row.className = 'category-row';
                row.innerHTML = `
                    <td>${category.maDanhMuc}</td>
                    <td>${category.maSanPham}</td>
                    <td>${category.tenDanhMuc}</td>
                    <td>${category.moTaDanhMuc || ''}</td>
                    <td class="action-buttons">
                        <button class="btn-edit" onclick="editCategory('${category.id}')">Sửa</button>
                        <button class="btn-delete" onclick="deleteCategory('${category.id}')">Xóa</button>
                    </td>
                `;
                categoryList.appendChild(row);
            });
        }

        // Modal functions
        function showAddCategoryModal() {
            document.getElementById('categoryModalTitle').textContent = 'Thêm Danh mục';
            document.getElementById('categoryForm').reset();
            document.getElementById('editCategoryId').value = '';
            document.getElementById('categoryModal').style.display = 'block';
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').style.display = 'none';
        }

        // Kiểm tra trùng mã danh mục và mã sản phẩm
        function checkDuplicateCategory(maDanhMuc, maSanPham, currentId = null) {
            return categories.some(category => 
                (category.maDanhMuc === maDanhMuc || category.maSanPham === maSanPham) && 
                category.id !== currentId
            );
        }

        // Xử lý form danh mục
        document.getElementById('categoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const editId = document.getElementById('editCategoryId').value;
            const maDanhMuc = document.getElementById('maDanhMuc').value;
            const maSanPham = document.getElementById('maSanPham').value;
            const tenDanhMuc = document.getElementById('tenDanhMuc').value;
            const moTaDanhMuc = document.getElementById('moTaDanhMuc').value;

            if (checkDuplicateCategory(maDanhMuc, maSanPham, editId)) {
                alert('Mã danh mục hoặc mã sản phẩm đã tồn tại! Vui lòng chọn mã khác.');
                return;
            }

            if (editId) {
                // Cập nhật danh mục
                const index = categories.findIndex(c => c.id === editId);
                if (index !== -1) {
                    categories[index] = { ...categories[index], maDanhMuc, maSanPham, tenDanhMuc, moTaDanhMuc };
                }
            } else {
                // Thêm danh mục mới
                const newCategory = {
                    id: Date.now().toString(),
                    maDanhMuc,
                    maSanPham,
                    tenDanhMuc,
                    moTaDanhMuc
                };
                categories.push(newCategory);
            }

            displayCategories();
            closeCategoryModal();
        });

        // Sửa danh mục
        function editCategory(id) {
            const category = categories.find(c => c.id === id);
            if (category) {
                document.getElementById('categoryModalTitle').textContent = 'Sửa Danh mục';
                document.getElementById('editCategoryId').value = category.id;
                document.getElementById('maDanhMuc').value = category.maDanhMuc;
                document.getElementById('maSanPham').value = category.maSanPham;
                document.getElementById('tenDanhMuc').value = category.tenDanhMuc;
                document.getElementById('moTaDanhMuc').value = category.moTaDanhMuc || '';
                document.getElementById('categoryModal').style.display = 'block';
            }
        }

        // Xóa danh mục
        function deleteCategory(id) {
            if (confirm('Bạn có chắc muốn xóa danh mục này?')) {
                categories = categories.filter(c => c.id !== id);
                displayCategories();
            }
        }

        // Tìm kiếm danh mục
       document.getElementById('searchCategory').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const filteredCategories = categories.filter(category => 
                category.tenDanhMuc.toLowerCase().includes(searchTerm) ||
                category.maDanhMuc.toLowerCase().includes(searchTerm) ||
                category.maSanPham.toLowerCase().includes(searchTerm)
            );
            displayFilteredCategories(filteredCategories);
        });

        // Hiển thị danh mục đã lọc
        function displayFilteredCategories(filteredCategories) {
            const categoryList = document.getElementById('categoryList');
            categoryList.innerHTML = '';
            
            filteredCategories.forEach(category => {
                const row = document.createElement('tr');
                row.className = 'category-row';
                row.innerHTML = `
                    <td>${category.maDanhMuc}</td>
                    <td>${category.maSanPham}</td>
                    <td>${category.tenDanhMuc}</td>
                    <td>${category.moTaDanhMuc || ''}</td>
                    <td class="action-buttons">
                        <button class="btn-edit" onclick="editCategory('${category.id}')">Sửa</button>
                        <button class="btn-delete" onclick="deleteCategory('${category.id}')">Xóa</button>
                    </td>
                `;
                categoryList.appendChild(row);
            });
        }

        // Xử lý đóng modal khi click ngoài
        window.onclick = function(event) {
            const modal = document.getElementById('categoryModal');
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }

        // Khởi tạo hiển thị ban đầu
        displayCategories();
    </script>
</body>
</html>
