<?php
include "connect.php";
require_once 'auth.php';
checkAdmin(['Admin']);
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
              class="app-menu__label">Xem Chi Tiết Hóa Đơn</span></a></li>
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
        <li class="breadcrumb-item active"><a href="#"><b>Danh sách sản phẩm</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">

                <a class="btn btn-add btn-sm" href="form-add-san-pham.php" title="Thêm"><i class="fas fa-plus"></i>
                  Tạo mới sản phẩm</a>
              </div>

              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i
                    class="fas fa-print"></i> In dữ liệu</a>
              </div>

              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm" type="button" title="Xóa" onclick="myFunction(this)"><i
                    class="fas fa-trash-alt"></i> Xóa tất cả </a>
              </div>
            </div>
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th width="10"><input type="checkbox" id="all"></th>
                  <th>Mã sản phẩm</th>
                  <th>Tên sản phẩm</th>
                  <th>Ảnh</th>
                  <th>Số lượng</th>
                  <th>Giá tiền</th>
                  <th>Danh mục</th>
                  <th>Chức năng</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Truy vấn sản phẩm và liên kết với bảng hình ảnh
                $query = "SELECT sp.MaSP, sp.TenSP, sp.SoLuong, sp.DonGia, sp.MaDanhMuc, sp.MaXuatXu, ha.URL, dm.TenDanhMuc
                      FROM sanpham sp 
                      LEFT JOIN hinhanh ha ON sp.MaSP = ha.MaSP
                      LEFT JOIN danhmucsp dm ON sp.MaDanhMuc = dm.MaDanhMuc";
                $result = $conn->query($query);
                if (!$result) {
                  die("Lỗi truy vấn: " . $conn->error); // Hiển thị lỗi và dừng thực hiện nếu truy vấn thất bại
                }
                if ($result->num_rows > 0) {
                  // Lặp qua từng dòng dữ liệu và xuất ra bảng
                  while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td width='10'><input type='checkbox' name='check1' value='1'></td>
                        <td>{$row['MaSP']}</td>
                        <td>{$row['TenSP']}</td>
                        <td>";
                    if (!empty($row['URL']) && file_exists($row['URL'])) {
                      echo "<img src='{$row['URL']}' alt='{$row['TenSP']}' width='100px'>";
                    } else {
                      echo "<img src='../img-sanpham/no-image.svg' alt='No image' width='100px'>";
                    }
                    echo "</td>
                        <td>{$row['SoLuong']}</td>
                        <td>" . number_format($row['DonGia']) . " VNĐ</td>
                        <td>{$row['TenDanhMuc']}</td>
                        <td>
                          <form action='./deleted-products.php?id={$row['MaSP']}' method='post' onsubmit='return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');'>
                                <button class='btn btn-primary btn-sm trash' type='submit' title='Xóa'>
                                    <i class='fas fa-trash-alt'></i>
                                </button>
                          </form>
                                <button class='btn btn-primary btn-sm edit' type='submit' title='Sửa' id='show-emp' data-toggle='modal' data-target='#ModalUP'>
                                    <i class='fas fa-edit'></i>
                                </button>
                          
                        </td>
                    </tr>";
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!--
  MODAL
-->
  <div class="modal fade" id="ModalUP" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-body">
          <div class="row">
            <div class="form-group  col-md-12">
              <span class="thong-tin-thanh-toan">
                <h5>Chỉnh sửa thông tin sản phẩm cơ bản</h5>
              </span>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="control-label">Mã sản phẩm </label>
              <input class="form-control" type="number" value="71309005">
            </div>
            <div class="form-group col-md-6">
              <label class="control-label">Tên sản phẩm</label>
              <input class="form-control" type="text" required value="Bàn ăn gỗ Theresa">
            </div>
            <div class="form-group  col-md-6">
              <label class="control-label">Số lượng</label>
              <input class="form-control" type="number" required value="20">
            </div>
            <!-- <div class="form-group col-md-6 ">
              <label for="exampleSelect1" class="control-label">Tình trạng sản phẩm</label>
              <select class="form-control" id="exampleSelect1">
                <option>Còn hàng</option>
                <option>Hết hàng</option>
                <option>Đang nhập hàng</option>
              </select>
            </div> -->
            <div class="form-group col-md-6">
              <label class="control-label">Giá bán </label>
              <input class="form-control" type="text" value="5.600.000">
            </div>
            <div class="form-group col-md-6">
              <label for="exampleSelect1" class="control-label">Danh mục</label>
              <select class="form-control" id="exampleSelect1">
                <option>Bàn ăn</option>
                <option>Bàn thông minh</option>
                <option>Tủ</option>
                <option>Ghế gỗ</option>
                <option>Ghế sắt</option>
                <option>Giường người lớn</option>
                <option>Giường trẻ em</option>
                <option>Bàn trang điểm</option>
                <option>Giá đỡ</option>
              </select>
            </div>
          </div>
          <BR>
          <a href="#" style="float: right; font-weight: 600; color: #ea0000;">Chỉnh sửa sản phẩm nâng cao</a>
          <BR>
          <BR>
          <button class="btn btn-save" type="button">Lưu lại</button>
          <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
          <BR>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!--
MODAL
-->

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
  <script type="text/javascript">
    $('#sampleTable').DataTable();
    //Thời Gian
    function time() {
      var today = new Date();
      var weekday = new Array(7);
      weekday[0] = "Chủ Nhật";
      weekday[1] = "Thứ Hai";
      weekday[2] = "Thứ Ba";
      weekday[3] = "Thứ Tư";
      weekday[4] = "Thứ Năm";
      weekday[5] = "Thứ Sáu";
      weekday[6] = "Thứ Bảy";
      var day = weekday[today.getDay()];
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      nowTime = h + " giờ " + m + " phút " + s + " giây";
      if (dd < 10) {
        dd = '0' + dd
      }
      if (mm < 10) {
        mm = '0' + mm
      }
      today = day + ', ' + dd + '/' + mm + '/' + yyyy;
      tmp = '<span class="date"> ' + today + ' - ' + nowTime +
        '</span>';
      document.getElementById("clock").innerHTML = tmp;
      clocktime = setTimeout("time()", "1000", "Javascript");

      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
    }
  </script>
  <script>
    function deleteRow(r) {
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("myTable").deleteRow(i);
    }
    jQuery(function() {
      jQuery(".trash").click(function() {
        swal({
            title: "Cảnh báo",
            text: "Bạn có chắc chắn là muốn xóa sản phẩm này?",
            buttons: ["Hủy bỏ", "Đồng ý"],
          })
          .then((willDelete) => {
            if (willDelete) {
              swal("Đã xóa thành công.!", {

              });
            }
          });
      });
    });
    oTable = $('#sampleTable').dataTable();
    $('#all').click(function(e) {
      $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
      e.stopImmediatePropagation();
    });
  </script>
</body>

</html>