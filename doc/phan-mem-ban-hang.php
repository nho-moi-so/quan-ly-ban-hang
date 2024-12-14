<?php
session_start();
include "connect.php";
require_once 'auth.php';
checkLogin();
checkAdmin(['Admin', 'NV']);
$currentRole = $_SESSION['user_role'];
$current_page = basename($_SERVER['PHP_SELF']);
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

<body class="app sidebar-mini rtl">
  <!-- Navbar-->
  <header class="app-header">
    <!-- Sidebar toggle button-->
    <!-- Navbar Right Menu-->
    <ul class="app-nav">

      <!-- User Menu-->
      <li><a class="app-nav__item" href="logout.php"><i class='bx bx-log-out bx-rotate-180'></i></a></li>

    </ul>
  </header>
  <!-- Sidebar menu-->
  <main class="app app-ban-hang">
    <div class="row">
      <div class="col-md-12">
        <div class="app-title">
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="#"><b>POS bán hàng</b></a></li>
          </ul>
          <div id="clock"></div>
        </div>
      </div>
    </div>
    <div class="row">

      <!------------------------------------------ TIM KIEM VA GIO HANG ------------------------------>
      <?php
      include 'connect.php';

      $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
      $sql = "SELECT * FROM sanpham WHERE TenSP LIKE '%$search%' OR MaSP LIKE '%$search%'";
      $result = $conn->query($sql);
      ?>

      <div class="row">
        <div class="col-md-8">
          <div class="tile">
            <h3 class="tile-title">Phần mềm bán hàng</h3>
            <form method="get" action="" class="d-flex">
              <input type="text" id="myInput" name="search" class="form-control" placeholder="Nhập mã sản phẩm hoặc tên sản phẩm để tìm kiếm..." class="form-control mr-2">
              <button type="submit" id="search-btn" class="btn btn-primary">Tìm kiếm</button>
            </form>
            <style>
              form.d-flex {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
              }

              form.d-flex input {
                flex-grow: 1;
                flex-grow: 1;
              }
            </style>

            <div class="du--lieu-san-pham" style="display: none;" id="product-section">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Mã hàng</th>
                    <th>Tên sản phẩm</th>
                    <!-- <th>Ảnh</th> -->
                    <th>Số lượng</th>
                    <th>Giá bán</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody id="product-list">
                  <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                      <tr>
                        <td><?= $row['MaSP'] ?></td>
                        <td><?= $row['TenSP'] ?></td>
                        <!-- <td><img src="../img-sanpham/uploads' . $product['MaSP'] . '.jpg" alt="" width="50px"></td> -->
                        <td><?= $row['Soluong'] ?></td>
                        <td><?= number_format($row['DonGia'], 0, ',', '.') ?> ₫</td>
                        <td>
                          <button class="btn btn-success btn-sm add-to-cart"
                            data-id="<?= $row['MaSP'] ?>"
                            data-name="<?= $row['TenSP'] ?>"
                            data-price="<?= number_format($row['DonGia'], 0, ',', '') ?>"
                            data-quantity="<?= $row['Soluong'] ?>">
                            Thêm
                          </button>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="6" class="text-center">Không tìm thấy sản phẩm nào</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <div class="cart-section">
              <h4>Giỏ hàng</h4>
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Mã hàng</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody id="cart-list">

                </tbody>
              </table>
            </div>

            <div class="alert">
              <i class="fas fa-exclamation-triangle"></i> Gõ mã hoặc tên sản phẩm vào thanh tìm kiếm để thêm hàng vào đơn hàng
            </div>
          </div>
        </div>

        <!------------------------------ THONG TIN THANH TOAN ---------------------------------->
        <?php
        $khachhang = null;
        if (isset($_GET['sdt'])) {
          $sdt = $_GET['sdt'];
          $sql_khachhang = "SELECT MaKH, TenKH FROM khachhang WHERE DienThoai = '$sdt'";
          $result_khachhang = $conn->query($sql_khachhang);
          $khachhang = ($result_khachhang && $result_khachhang->num_rows > 0) ? $result_khachhang->fetch_assoc() : null;
        }

        $sql_nhanvien = "SELECT id, ho_ten FROM nhanvien";
        $result_nhanvien = $conn->query($sql_nhanvien);

        $conn->close();
        ?>
        <div class="col-md-4">
          <div class="tile">
            <h3 class="tile-title">Thông tin thanh toán</h3>
            <div class="row">

              <div class="form-group col-md-10">
                <label class="control-label">SĐT khách hàng</label>
                <input class="form-control" type="text" id="sdt" placeholder="Tìm kiếm khách hàng" value="<?php echo isset($_GET['sdt']) ? $_GET['sdt'] : ''; ?>">
              </div>
              <div class="form-group col-md-2">
                <label style="text-align: center;" class="control-label">Tìm</label>
                <button class="btn btn-primary btn-timkiem" onclick="searchCustomer()">
                  <i class="fas fa-search"></i>
                </button>
              </div>
              <div class="form-group col-md-12">
                <small class="text-danger" id="customerInfo" style="font-size: 14px;"></small>
              </div>
              <div class="form-group col-md-auto">
                <label style="text-align: center;" class="control-label">Tạo mới</label>
                <a href="form-add-khach-hang.php" class="btn btn-primary btn-them">
                  <i class="fas fa-user-plus"></i>
                </a>
              </div>

              <!-- <div class="form-group col-md-12">
                <label class="control-label">Nhân viên bán hàng</label>
                <select class="form-control" id="exampleSelect1">
                  <option>--- Chọn nhân viên bán hàng ---</option>
                  <?php while ($row = $result_nhanvien->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>">
                      <?php echo $row['id'] . '-' . $row['ho_ten']; ?>
                    </option>
                  <?php endwhile; ?>
                </select>
              </div> -->
              <div class="form-group col-md-12">
                <label class="control-label">Ghi chú đơn hàng</label>
                <textarea class="form-control" rows="4" placeholder="Ghi chú thêm đơn hàng"></textarea>
              </div>
            </div>
            <div class="form-group col-md-12">
              <label class="control-label">Hình thức thanh toán</label><br>
              <input type="radio" id="tienmat" name="hinhthucthanhtoan" value="Tiền mặt">
              <label for="tienmat">Tiền mặt</label><br>
              <input type="radio" id="chuyenkhoan" name="hinhthucthanhtoan" value="Chuyển khoản">
              <label for="chuyenkhoan">Chuyển khoản</label><br>
            </div>

            <div id="chuyen_khoan_fields" style="display:none;">
              <div class="form-group col-md-12">
                <label class="control-label">Số tài khoản</label>
                <input class="form-control" type="text" name="so_tai_khoan" id="so_tai_khoan">
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Tên tài khoản</label>
                <input class="form-control" type="text" name="ten_tai_khoan" id="ten_tai_khoan">
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Ngân hàng</label>
                <select id="ten_ngan_hang" name="ten_ngan_hang" class="form-control">
                  <option value="Vietcombank">Vietcombank</option>
                  <option value="Techcombank">Techcombank</option>
                  <option value="BIDV">BIDV</option>
                  <option value="ACB">ACB</option>
                  <option value="MB Bank">MB Bank</option>
                  <option value="VietinBank">VietinBank</option>
                  <option value="Sacombank">Sacombank</option>
                </select>
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Ngày chuyển khoản</label>
                <input class="form-control" type="date" name="ngay_chuyen_khoan" id="ngay_chuyen_khoan">
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Số tiền chuyển khoản</label>
                <input class="form-control" type="text" name="so_tien_chuyen_khoan" id="so_tien_chuyen_khoan" readonly>
              </div>
            </div>

            <div class="form-group col-md-12">
              <label class="control-label">Tạm tính tiền hàng: </label>
              <p id="tam-tinh" class="control-all-money-tamtinh">0 ₫</p>
            </div>
            <div class="form-group col-md-12">
              <label class="control-label">Tổng cộng thanh toán: </label>
              <p id="tong-tien" class="control-all-money-total">0 ₫</p>
            </div>

            <div id="tienmat_fields" style="display:none;">
              <div class="form-group col-md-12">
                <label class="control-label">Tiền nhận: </label>
                <input class="form-control" type="text" id="tien_nhan" name="tien_nhan">
              </div>
              <!-- <div class="col-md-12 d-flex align-items-center">
                <button type="button" class="btn btn-info" id="tinh_tien_thoi">Tính tiền thối</button>
              </div> -->
              <style>
                .btn-info {
                  margin-top: 10px;
                }
              </style>
              <div class="form-group col-md-12">
                <label class="control-label">Tiền thừa: </label>
                <p id="tienso" class="control-all-money">0 VNĐ</p>
              </div>
            </div>
            <form id="orderForm" method="POST" action="save_order.php">
              <!-- Các phần khác của form -->
              <input id="ma_kh" type="hidden" name="ma_kh" value="<?php echo isset($khachhang['MaKH']) ? $khachhang['MaKH'] : ''; ?>">
              <input id="tong_tien" type="hidden" name="tong_tien" value="<?php echo $tongcong; ?>">
              <div class="tile-footer col-md-12">
                <button class="btn btn-primary luu-san-pham" type="submit">Lưu đơn hàng</button>
                <!-- <button class="btn btn-primary luu-va-in" type="submit">In hóa đơn</button> -->
                <a class="btn btn-secondary luu-va-in" href="index.php">Quay về</a>
              </div>
            </form>
            </form>
            <script>
              document.querySelectorAll('input[name="hinhthucthanhtoan"]').forEach((elem) => {
                elem.addEventListener('change', function() {
                  if (this.value == 'Chuyển khoản') {

                    document.getElementById('chuyen_khoan_fields').style.display = 'block';
                    document.getElementById('tienmat_fields').style.display = 'none';

                  } else if (this.value == 'Tiền mặt') {

                    document.getElementById('tienmat_fields').style.display = 'block';
                    document.getElementById('chuyen_khoan_fields').style.display = 'none';
                  }
                });
              });
            </script>
  </main>
  <!----------------------------------------MODAL TAO KH MOI--------------------------------------->
  <?php
  include 'connect.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_kh = isset($_POST['ten_kh']) ? $_POST['ten_kh'] : null;
    $ngay_sinh = isset($_POST['ngay_sinh']) ? $_POST['ngay_sinh'] : null;
    $dien_thoai = isset($_POST['dien_thoai']) ? $_POST['dien_thoai'] : null;
    $ngay_them = isset($_POST['ngay_them']) ? $_POST['ngay_them'] : null;

    if ($ten_kh && $ngay_sinh && $dien_thoai && $ngay_them) {

      // Kiểm tra số điện thoại có tồn tại trong hệ thống không
      $check_sdt = $conn->prepare("SELECT * FROM khachhang WHERE DienThoai = ?");
      $check_sdt->bind_param("s", $dien_thoai);
      $check_sdt->execute();
      $result = $check_sdt->get_result();

      if ($result->num_rows > 0) {
        echo "<script>alert('Số điện thoại này đã tồn tại trong hệ thống!');</script>";
      } else {
        // Thêm khách hàng vào cơ sở dữ liệu (cột MaKH sẽ tự động tăng)
        $sql_insert = $conn->prepare("INSERT INTO khachhang (TenKH, DienThoai, NgayLap) VALUES (?, ?, ?)");
        $sql_insert->bind_param("sss", $ten_kh, $dien_thoai, $ngay_them);

        if ($sql_insert->execute()) {
          // Chuyển hướng lại trang sau khi thêm thành công
          header("Location: " . $_SERVER['PHP_SELF']);
          exit();
        } else {
          echo "<script>alert('Lỗi: " . $conn->error . "');</script>";
        }
      }

      $check_sdt->close();
    } else {
      // echo "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
    }
  }

  $sql = "SELECT * FROM khachhang ORDER BY MaKH DESC";
  $result = $conn->query($sql);
  ?>

  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form action="" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="form-group col-md-12">
                <span class="thong-tin-thanh-toan">
                  <h5>Tạo mới khách hàng</h5>
                </span>
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Mã khách hàng</label>
                <input class="form-control" type="text" value="Mã khách hàng sẽ tự động sinh" readonly>
              </div>
              <div class="form-group col-md-12">
                <label class="control-label">Họ và tên</label>
                <input class="form-control" type="text" name="ten_kh" required>
              </div>

              <div class="form-group col-md-6">
                <label class="control-label">Ngày sinh</label>
                <input class="form-control" type="date" name="ngay_sinh" required>
              </div>
              <div class="form-group col-md-6">
                <label class="control-label">Số điện thoại</label>
                <input class="form-control" type="number" name="dien_thoai" required>
              </div>
              <div class="form-group col-md-6">
                <label class="control-label">Ngày thêm</label>
                <input class="form-control" type="date" name="ngay_them" required>
              </div>
            </div>
            <br>
            <button class="btn btn-save" type="submit">Lưu lại</button>
            <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
            <br>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  $conn->close();
  ?>


  <!-----------------------------MODAL------------------------->

  <!-- The Modal -->
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">X</span>
      </div>
    </div>
  </div>
  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
    function formatCurrencyVND(amount) {
      if (isNaN(amount)) return '0 VND';
      return amount.toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND'
      });
    }

    function parseCurrencyVND(value) {
      return parseInt(value.replace(/[^0-9]/g, ''), 10);
    }

    function formatNumberInput(input) {
      let value = input.value;
      value = value.replace(/[^0-9]/g, "");
      value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      input.value = value;
    }

    function calculateChange() {
      const total = parseCurrencyVND($('#tong-tien').text()) || 0;
      const paid = parseCurrencyVND($('#tien_nhan').val()) || 0;
      const paidEle = $("#tienso");
      const change = paid - total;

      if (change < 0) {
        paidEle.css("color", "red");
        paidEle.text(function() {
          return `${formatCurrencyVND(change)} (Không đủ)`;
        });
      }

      paidEle.text(function() {
        return formatCurrencyVND(change);
      });
    }

    $('#tien_nhan').on("input", function() {
      formatNumberInput(this);
      calculateChange();
    })
  </script>

  <!--------------------------- tìm kiếm khách hàng -------------------------------------->
  <script>
    function searchCustomer() {
      const sdt = document.getElementById('sdt').value;

      if (sdt.trim() === '') {
        alert('Vui lòng nhập số điện thoại để tìm kiếm.');
        return;
      }

      window.history.pushState({}, '', `?sdt=${encodeURIComponent(sdt)}`);

      fetch('search_customer.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `sdt=${encodeURIComponent(sdt)}`
        })
        .then(response => response.json())
        .then(data => {
          const resultContainer = document.getElementById('customerInfo');

          if (data.status === 'success') {
            resultContainer.innerHTML = `Mã khách hàng: <normal class="text-success">${data.MaKH}</normal> - Họ và tên: <normal class="text-success">${data.TenKH}</normal>`;
          } else {
            resultContainer.innerHTML = `<normal class="text-danger">${data.message}</normal>`;
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  </script>

  <!------------------------------ tim kiem va gio hang  -------------------------------->
  <script>
    let paymentMethod = ""

    $(document).ready(function() {
      const cartList = $('#cart-list');
      const allMoneyTamtinh = $('.control-all-money-tamtinh');
      const allMoneyTotal = $('.control-all-money-total');
      const customerPaymentInput = $('input[type="number"]');
      const customerDebt = $('.control-all-money');

      //tim kiem sp
      $('#search-btn').click(function(event) {
        event.preventDefault();
        const searchTerm = $('#myInput').val().trim();
        if (searchTerm) {
          $.ajax({
            method: 'GET',
            data: {
              search: searchTerm
            },
            success: function(response) {
              const newTableRows = $(response).find('#product-list').html();
              $('#product-list').html(newTableRows);
              $('#product-section').toggle(newTableRows.trim() !== "");
            },
            error: function() {
              alert('Đã xảy ra lỗi khi tìm kiếm.');
            }
          });
        } else {
          alert('Vui lòng nhập từ khóa để tìm kiếm.');
        }
      });

      //them sp vao gio
      $(document).on('click', '.add-to-cart', function() {
        const productId = $(this).data('id');
        const productName = $(this).data('name');
        const productPrice = $(this).data('price');
        const productQuantityInStock = $(this).data('quantity');
        const productRow = cartList.find(`tr[data-id="${productId}"]`);
        const formattedPrice = formatCurrencyVND(productPrice);

        if (productRow.length) {
          const quantityInput = productRow.find('.quantity');
          let currentQuantity = parseInt(quantityInput.val());

          if (currentQuantity >= productQuantityInStock) {
            alert('Số lượng sản phẩm này đã đạt giới hạn trong kho!');
            return;
          }
          quantityInput.val(currentQuantity + 1);
        } else {
          const newRow = `
                <tr data-id="${productId}" data-name="${productName}" data-price="${productPrice}">
                    <td data-product-id="${productId}">${productId}</td>
                    <td data-name="${productName}">${productName}</td>
                    <td><input type="number" class="form-control quantity" value="1" min="1" max="${productQuantityInStock}" style="width: 70px;"></td>
                    <td data-price="${productPrice}">${formattedPrice}</td>
                    <td><button class="btn btn-danger btn-sm remove-from-cart">Xóa</button></td>
                </tr>`;
          cartList.append(newRow);
        }
        updateTotalAmount();
      });

      //xoa sp khoi gio
      $(document).on('click', '.remove-from-cart', function() {
        $(this).closest('tr').remove();
        updateTotalAmount();
      });

      //update tong tien
      function updateTotalAmount() {
        let total = 0;
        cartList.find('tr').each(function() {
          const price = $(this).data('price')
          const quantity = parseInt($(this).find('.quantity').val());

          total += price * quantity;
        });

        allMoneyTamtinh.text(formatCurrencyVND(total));
        allMoneyTotal.text(formatCurrencyVND(total));
        calculateChange()
      }

      function updateCustomerDebt(totalAmount) {
        const paymentAmount = parseInt(customerPaymentInput.val()) || 0;
        const debt = totalAmount - paymentAmount;
        customerDebt.text(`- ${formatCurrencyVND(debt)}`);
      }

      //so luong hang
      $(document).on('input', '.quantity', function() {
        const quantityInput = $(this);
        const maxQuantity = parseInt(quantityInput.attr('max'));
        let newQuantity = parseInt(quantityInput.val());

        if (newQuantity > maxQuantity) {
          alert(`Chỉ còn ${maxQuantity} sản phẩm trong kho.`);
          quantityInput.val(maxQuantity);
        }
        updateTotalAmount();
      });
    });

    //auto nhap tien chuyen khoan
    $(document).ready(function() {
      const allMoneyTotal = $('.control-all-money-total');
      const transferAmountInput = $('#so_tien_chuyen_khoan');

      $('input[name="hinhthucthanhtoan"]').on('change', function() {
        paymentMethod = $(this).val();

        if ($(this).val() === 'Chuyển khoản') {
          const totalAmountValue = parseInt(allMoneyTotal.text().replace(/[^0-9]/g, '')) || 0;
          transferAmountInput.val(formatCurrencyVND(totalAmountValue));
        } else {
          transferAmountInput.val('');
        }
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      function getCartItems() {
        const items = [];

        $('#cart-list tr').each(function() {
          const row = $(this);
          const id = row.data('id');
          const name = row.data('name').trim();
          const quantity = parseInt(row.find('.quantity').val(), 10);
          const price = row.data('price')

          items.push({
            id,
            name,
            quantity,
            price
          });
        });

        return items;
      }

      $('#orderForm').on('submit', function(e) {
        e.preventDefault();
        const totalAmount = parseCurrencyVND($('#tong-tien').text());
        const tien_nhan = parseCurrencyVND($('#tien_nhan').val());
        const so_tai_khoan = $('#so_tai_khoan').val();
        const ten_tai_khoan = $('#ten_tai_khoan').val();
        const ten_ngan_hang = $('#ten_ngan_hang').val();
        const ngay_chuyen_khoan = $('#ngay_chuyen_khoan').val();
        const so_tien_chuyen_khoan = $('#so_tien_chuyen_khoan').val();
        const maKH = $("#ma_kh").val();
        const cartItems = getCartItems()
        let formData = `&ma_kh=${maKH}&tong_tien=${totalAmount}&cart_items=${JSON.stringify(cartItems)}&phuong_thuc_thanh_toan=${paymentMethod}`;

        if (!totalAmount) {
          alert("Tổng tiền không hợp lệ!");
          return;
        }

        if (!paymentMethod) {
          alert("Chọn phương thức thanh toán!");
          return;
        } else {
          if (paymentMethod == "Tiền mặt") {
            if (!tien_nhan) {
              alert("Nhập số tiền nhận!");
              return;
            }

            const tien_thua = tien_nhan - totalAmount

            if (tien_thua < 0) {
              alert("Tiền nhận không đủ!");
              return;
            }

            formData += `&tien_nhan=${tien_nhan}&tien_thua=${tien_thua}`
          } else if (paymentMethod == "Chuyển khoản") {
            if (!so_tai_khoan || !ten_tai_khoan || !ten_ngan_hang || !ngay_chuyen_khoan || !so_tien_chuyen_khoan) {
              alert("Nhập đủ thông tin chuyển khoản!");
              return;
            }

            formData += `&so_tai_khoan=${so_tai_khoan}&ten_tai_khoan=${ten_tai_khoan}&ten_ngan_hang=${ten_ngan_hang}&ngay_chuyen_khoan=${ngay_chuyen_khoan}&so_tien_chuyen_khoan=${parseCurrencyVND(so_tien_chuyen_khoan)}`
          }
        }


        console.log(formData);

        $.ajax({
          url: 'save_order.php',
          type: 'POST',
          data: formData,
          success: function(response) {
            const result = JSON.parse(response);

            if (result.success) {
              alert('Lưu đơn hàng thành công!');
              location.reload();
            } else {
              alert('Có lỗi xảy ra: ' + result.error);
            }
          },
          error: function() {
            alert('Lỗi khi gửi dữ liệu!');
          }
        });
      });
    });
  </script>
</body>

</html>