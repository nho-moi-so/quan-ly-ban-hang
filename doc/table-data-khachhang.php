<?php
include "connect.php";
require_once 'auth.php';
checkAdmin((['Admin', 'NV']));
$currentRole = $_SESSION['user_role'];
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách Khách Hàng | Quản trị Admin</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
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
        <li class="breadcrumb-item active"><a href="./table-data-khachhang.php"><b>Danh sách Khách Hàng</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="./form-add-khach-hang.php" title="Thêm"><i class="fas fa-plus"></i> Tạo Khách Hàng Mới</a>
              </div>

              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
              </div>

              <div class="col-sm-2">
                <button class="btn btn-delete btn-sm" type="button" onclick="deleteSelectedKH()">
                  <i class="fas fa-trash-alt"></i> Xóa các mục đã chọn
                </button>
              </div>


            </div>

            <?php
            // Truy vấn sản phẩm và liên kết với bảng hình ảnh
            $query = "SELECT kh.MaKH, kh.TenKH, kh.DienThoai AS SDT, kh.DiemTichLuy, kh.NgayLap AS NgayTichDiem
          FROM khachhang kh ";
            $result = $conn->query($query);

            if (!$result) {
              die("Lỗi truy vấn: " . $conn->error);
            }

            if ($result->num_rows > 0) {
            ?>
              <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0" id="sampleTable">
                <thead>
                  <tr>
                    <th width="10"><input type="checkbox" id="select-all"></th>
                    <th>ID Khách Hàng</th>
                    <th width="150">Họ và tên</th>
                    <th>SĐT</th>
                    <th>Điểm Tich Lũy</th>
                    <th>Ngày Tích Điểm</th>
                    <th width="100">Tính năng</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row = $result->fetch_assoc()) {
                  ?>
                    <tr>
                      <td><input type="checkbox" name="check1[]" value="<?php echo $row['MaKH']; ?>"></td>
                      <td><?php echo $row['MaKH']; ?></td>
                      <td><?php echo $row['TenKH']; ?></td>
                      <td><?php echo $row['SDT']; ?></td>
                      <td><?php echo number_format($row['DiemTichLuy'], 0, ',', '.') . ' VND'; ?></td>
                      <td><?php echo $row['NgayTichDiem']; ?></td>
                      <td>
                        <form action="./deleted-kh.php?id=<?php echo htmlspecialchars($row['MaKH']); ?>" method="post">
                          <button class="btn btn-primary btn-sm trash" type="submit" title="Xóa">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </form>
                        <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" data-toggle="modal" data-target="#ModalUP" data-id="<?php echo $row['MaKH']; ?>">
                          <i class="fas fa-edit"></i>
                        </button>
                      </td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            <?php
            } else {
              echo "<p>Không có kết quả tìm kiếm.</p>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!----------MODAL------------>
  <div class="modal fade" id="ModalUP" tabindex="-1" role="dialog" aria-labelledby="ModalUPLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalUPLabel">Sửa thông tin Khách Hàng</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="update_employee.php">
            <input type="hidden" id="employee_id" name="id">
            <div class="form-group">
              <label for="ho_ten">Họ và tên</label>
              <input class="form-control" type="text" id="ho_ten" name="ho_ten" required>
            </div>

            <div class="form-group">
              <label for="sdt">SĐT</label>
              <input class="form-control" type="text" id="sdt" name="sdt" required>
            </div>

            <button class="btn btn-primary" type="submit">Cập nhật</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!----------------MODAL------------------>

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

            text: "Bạn có chắc chắn là muốn xóa khách hàng này?",
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

    //In dữ liệu
    var myApp = new function() {
      this.printTable = function() {
        var tab = document.getElementById('sampleTable');
        var win = window.open('', '', 'height=700,width=700');
        win.document.write(tab.outerHTML);
        win.document.close();
        win.print();
      }
    }


    //Modal
    $("#show-emp").on("click", function() {
      $("#ModalUP").modal({
        backdrop: false,
        keyboard: false
      })
    });
  </script>

  <!-- Xóa các mục đã chọn -->
  <script>
    document.getElementById('select-all').addEventListener('change', function() {
      const checkboxes = document.querySelectorAll('input[name="check"]');
      checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
  </script>


</body>

</html>