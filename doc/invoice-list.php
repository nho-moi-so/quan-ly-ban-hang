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

        .container {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }

        button.edit {
            background-color: #2196F3;
        }

        button.delete {
            background-color: #f44336;
        }

        button:hover {
            opacity: 0.8;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            padding: 8px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 50%;
            max-width: 500px;
        }

        .close {
            float: right;
            cursor: pointer;
            font-size: 24px;
        }

        .close:hover {
            color: #f44336;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
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
                <li><a class="app-menu__item <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="./index.php"><i class='app-menu__icon bx bx-tachometer'></i><span
                            class="app-menu__label">Bảng điều khiển</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-table.php') ? 'active' : '' ?>" href="./table-data-table.php"><i class='app-menu__icon bx bx-id-card'></i> <span
                            class="app-menu__label">Quản lý nhân viên</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin', 'NV'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-khachhang.php') ? 'active' : '' ?>" href="./table-data-khachhang.php"><i class='app-menu__icon bx bx-user-voice'></i><span
                            class="app-menu__label">Quản lý khách hàng</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-product.php') ? 'active' : '' ?>" href="./table-data-product.php"><i
                            class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
                </li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-oder.php') ? 'active' : '' ?>" href="./table-data-oder.php"><i class='app-menu__icon bx bx-task'></i><span
                            class="app-menu__label">Quản lý Hóa Đơn</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-danh-muc.php') ? 'active' : '' ?>" href="./table-data-danh-muc.php"><i class='app-menu__icon bx bx-task'></i><span
                            class="app-menu__label">Quản lý Danh Mục</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-xuat-xu.php') ? 'active' : '' ?>" href="./table-data-xuat-xu.php"><i class='app-menu__icon bx bx-task'></i><span
                            class="app-menu__label">Quản lý xuất xứ</span></a></li>
            <?php endif; ?>
            <?php if (in_array($currentRole, ['Admin'])): ?>
                <li><a class="app-menu__item <?= ($current_page == 'table-data-don-vi-tinh.php') ? 'active' : '' ?>" href="./table-data-don-vi-tinh.php"><i class='app-menu__icon bx bx-task'></i><span
                            class="app-menu__label">Quản lý đơn vị tính</span></a></li>
            <?php endif; ?>
            <!-- <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Cài
            đặt hệ thống</span></a></li> -->
        </ul>
    </aside>
    <main class="app-content">
        <div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="#"><b>Lập hóa đơn/Danh sách đơn hàng</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row element-button">
                            <div class="col-sm-2">
                                <a class="btn btn-add btn-sm" href="./display-invoice.php" title="Thêm"><i class="fas fa-plus"></i>
                                    Chi tiết hóa đơn</a>
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
                    <h2>Danh Sách Hóa Đơn</h2>
                    <button onclick="window.location.href='create-invoice.html'">Tạo Hóa Đơn Mới</button>
                </div> -->

                            <div class="search-box">
                                <input type="text" id="searchInput" placeholder="Tìm kiếm hóa đơn..." onkeyup="searchInvoices()">
                            </div>

                            <table id="invoiceTable">
                                <thead>
                                    <tr>
                                        <th>Mã Hóa Đơn</th>
                                        <th>Ngày Giờ Bán</th>
                                        <th>Mã Nhân Viên</th>
                                        <th>Mã Khách Hàng</th>
                                        <th>Phương Thức TT</th>
                                        <th>Tổng Tiền</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <!-- Modal Chỉnh Sửa -->
                        <div id="editModal" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal()">&times;</span>
                                <h3>Chỉnh Sửa Hóa Đơn</h3>
                                <form id="editForm">
                                    <div class="form-group">
                                        <label for="editInvoiceId">Mã Hóa Đơn:</label>
                                        <input type="text" id="editInvoiceId" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="editEmployeeId">Mã Nhân Viên:</label>
                                        <input type="text" id="editEmployeeId" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editDateTime">Ngày Giờ Bán:</label>
                                        <input type="datetime-local" id="editDateTime" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editPaymentMethod">Phương Thức Thanh Toán:</label>
                                        <select id="editPaymentMethod" required>
                                            <option value="cash">Tiền mặt</option>
                                            <option value="card">Thẻ ngân hàng</option>
                                            <option value="transfer">Chuyển khoản</option>
                                            <option value="momo">Ví MoMo</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="editCustomerId">Mã Khách Hàng:</label>
                                        <input type="text" id="editCustomerId" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editTotalAmount">Tổng Tiền:</label>
                                        <input type="number" id="editTotalAmount" min="0" required>
                                    </div>
                                    <button type="submit">Lưu Thay Đổi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let invoices = [];

            // Hàm chuyển đổi phương thức thanh toán
            function getPaymentMethodText(method) {
                const methods = {
                    'cash': 'Tiền mặt',
                    'card': 'Thẻ ngân hàng',
                    'transfer': 'Chuyển khoản',
                    'momo': 'Ví MoMo'
                };
                return methods[method] || method;
            }

            // Hàm định dạng tiền tệ
            function formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(amount);
            }

            // Hàm hiển thị danh sách hóa đơn
            function displayInvoices(invoicesToDisplay = invoices) {
                const tbody = document.querySelector('#invoiceTable tbody');
                tbody.innerHTML = '';

                invoicesToDisplay.forEach((invoice, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                    <td>${invoice.invoiceId}</td>
                    <td>${new Date(invoice.dateTime).toLocaleString('vi-VN')}</td>
                    <td>${invoice.employeeId}</td>
                    <td>${invoice.customerId}</td>
                    <td>${getPaymentMethodText(invoice.paymentMethod)}</td>
                    <td>${formatCurrency(invoice.totalAmount)}</td>
                    <td>
                        <button class="edit" onclick="openEditModal('${invoice.invoiceId}')">Sửa</button>
                        <button class="delete" onclick="deleteInvoice('${invoice.invoiceId}')">Xóa</button>
                        <button onclick="viewInvoice('${invoice.invoiceId}')">Xem</button>
                    </td>
                `;
                    tbody.appendChild(tr);
                });
            }

            // Hàm tìm kiếm hóa đơn
            function searchInvoices() {
                const searchText = document.getElementById('searchInput').value.toLowerCase();
                const filteredInvoices = invoices.filter(invoice =>
                    invoice.invoiceId.toLowerCase().includes(searchText) ||
                    invoice.employeeId.toLowerCase().includes(searchText) ||
                    invoice.customerId.toLowerCase().includes(searchText)
                );
                displayInvoices(filteredInvoices);
            }

            // Hàm mở modal chỉnh sửa
            function openEditModal(invoiceId) {
                const invoice = invoices.find(inv => inv.invoiceId === invoiceId);
                if (invoice) {
                    document.getElementById('editInvoiceId').value = invoice.invoiceId;
                    document.getElementById('editEmployeeId').value = invoice.employeeId;
                    document.getElementById('editDateTime').value = invoice.dateTime;
                    document.getElementById('editPaymentMethod').value = invoice.paymentMethod;
                    document.getElementById('editCustomerId').value = invoice.customerId;
                    document.getElementById('editTotalAmount').value = invoice.totalAmount;

                    document.getElementById('editModal').style.display = 'block';
                }
            }

            // Hàm đóng modal
            function closeModal() {
                document.getElementById('editModal').style.display = 'none';
            }

            // Xử lý sự kiện submit form chỉnh sửa
            document.getElementById('editForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const editedInvoice = {
                    invoiceId: document.getElementById('editInvoiceId').value,
                    employeeId: document.getElementById('editEmployeeId').value,
                    dateTime: document.getElementById('editDateTime').value,
                    paymentMethod: document.getElementById('editPaymentMethod').value,
                    customerId: document.getElementById('editCustomerId').value,
                    totalAmount: document.getElementById('editTotalAmount').value
                };

                const index = invoices.findIndex(inv => inv.invoiceId === editedInvoice.invoiceId);
                if (index !== -1) {
                    invoices[index] = editedInvoice;
                    localStorage.setItem('invoices', JSON.stringify(invoices));
                    displayInvoices();
                    closeModal();
                }
            });

            // Hàm xóa hóa đơn
            function deleteInvoice(invoiceId) {
                if (confirm('Bạn có chắc chắn muốn xóa hóa đơn này?')) {
                    invoices = invoices.filter(inv => inv.invoiceId !== invoiceId);
                    localStorage.setItem('invoices', JSON.stringify(invoices));
                    displayInvoices();
                }
            }

            // Hàm xem hóa đơn
            /*/ function viewInvoice(invoiceId) {
                 const invoice = invoices.find(inv => inv.invoiceId === invoiceId);
                 if (invoice) {
                     localStorage.setItem('currentInvoice', JSON.stringify(invoice));
                     window.open('display-invoice.php', '_blank');
                 }
             }/*/

            // Khởi tạo khi tải trang
            document.addEventListener('DOMContentLoaded', function() {
                // Lấy danh sách hóa đơn từ localStorage
                const storedInvoices = localStorage.getItem('invoices');
                if (storedInvoices) {
                    invoices = JSON.parse(storedInvoices);
                    displayInvoices();
                }
            });

            // Đóng modal khi click bên ngoài
            window.onclick = function(event) {
                const modal = document.getElementById('editModal');
                if (event.target === modal) {
                    closeModal();
                }
            }
        </script>
    </main>
</body>

</html>