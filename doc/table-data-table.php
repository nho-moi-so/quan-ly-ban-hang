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
      <li><a class="app-menu__item haha" href="./phan-mem-ban-hang.html"><i class='app-menu__icon bx bx-cart-alt'></i>
          <span class="app-menu__label">POS Bán Hàng</span></a></li>
      <li><a class="app-menu__item " href="./index.php"><i class='app-menu__icon bx bx-tachometer'></i><span
            class="app-menu__label">Bảng điều khiển</span></a></li>
      <li><a class="app-menu__item active" href="./table-data-table.php"><i class='app-menu__icon bx bx-id-card'></i>
          <span class="app-menu__label">Quản lý nhân viên</span></a></li>
      <li><a class="app-menu__item" href="./table-data-khachhang.php"><i class='app-menu__icon bx bx-user-voice'></i><span
            class="app-menu__label">Quản lý khách hàng</span></a></li>
      <li><a class="app-menu__item" href="./table-data-product.php"><i
            class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
      </li>
      <li><a class="app-menu__item" href="./table-data-oder.html"><i class='app-menu__icon bx bx-task'></i><span
            class="app-menu__label">Quản lý đơn hàng</span></a></li>
      <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Cài
            đặt hệ thống</span></a></li>
    </ul>
  </aside>


<!-- Danh sách nhân viên-->
<?php
include 'connect.php';

$sql = "SELECT id, ho_ten, anh_3x4, dia_chi, ngay_sinh, gioi_tinh, sdt, chuc_vu FROM nhanvien";
$result = $conn->query($sql);
?>

<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách nhân viên</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="row element-button">
                        <div class="col-sm-2">
                            <a class="btn btn-add btn-sm" href="./form-add-nhan-vien.php" title="Thêm"><i class="fas fa-plus"></i> Tạo mới nhân viên</a>
                        </div>
                        
                        <div class="col-sm-2">
                            <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i class="fas fa-print"></i> In dữ liệu</a>
                        </div>
                       
                        <div class="col-sm-2">
                            <button class="btn btn-delete btn-sm" type="button" onclick="deleteSelectedEmployees()">
                                <i class="fas fa-trash-alt"></i> Xóa các mục đã chọn
                            </button>
                        </div>

                        
                    </div>

                    <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0" id="sampleTable">
                        <thead>
                            <tr>
                                <th width="10"><input type="checkbox" id="select-all"></th>
                                <th>ID nhân viên</th>
                                <th width="150">Họ và tên</th>
                                <th width="20">Ảnh thẻ</th>
                                <th width="300">Địa chỉ</th>
                                <th>Ngày sinh</th>
                                <th>Giới tính</th>
                                <th>SĐT</th>
                                <th>Chức vụ</th>
                                <th width="100">Tính năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM nhanvien"; 
                            $result = $conn->query($sql);
                            if ($result && $result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td width='10'><input type='checkbox' name='check' value='{$row['id']}'></td>";
                                    echo "<td>#{$row['id']}</td>";
                                    echo "<td>{$row['ho_ten']}</td>";
                                    echo "<td><img class='img-card-person' src='../img-anhthe/{$row['anh_3x4']}' alt=''></td>";
                                    echo "<td>{$row['dia_chi']}</td>";
                                    echo "<td>{$row['ngay_sinh']}</td>";
                                    echo "<td>{$row['gioi_tinh']}</td>";
                                    echo "<td>{$row['sdt']}</td>";
                                    echo "<td>{$row['chuc_vu']}</td>";
                                    echo "<td>
                                            <form method='POST' action='delete_employee.php'>
                                                <input type='hidden' name='id' value='{$row['id']}'>
                                                <button class='btn btn-danger btn-sm' type='submit' title='Xóa'>
                                                    <i class='fas fa-trash-alt'></i>
                                                </button>
                                            </form>
                                            
                                            <button class='btn btn-primary btn-sm edit' type='button' title='Sửa' data-toggle='modal' data-target='#ModalUP' onclick='loadEmployeeData({$row['id']})'>
                                                <i class='fas fa-edit'></i>
                                            </button>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='10'>Không có dữ liệu</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
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
                <h5 class="modal-title" id="ModalUPLabel">Sửa thông tin nhân viên</h5>
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
                        <label for="anh_3x4">Ảnh thẻ</label>
                        <input class="form-control" type="text" id="anh_3x4" name="anh_3x4">
                    </div>
                    <div class="form-group">
                        <label for="dia_chi">Địa chỉ</label>
                        <input class="form-control" type="text" id="dia_chi" name="dia_chi" required>
                    </div>
                    <div class="form-group">
                        <label for="ngay_sinh">Ngày sinh</label>
                        <input class="form-control" type="date" id="ngay_sinh" name="ngay_sinh" required>
                    </div>
                    <div class="form-group">
                        <label for="gioi_tinh">Giới tính</label>
                        <select class="form-control" id="gioi_tinh" name="gioi_tinh" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sdt">Số điện thoại</label>
                        <input class="form-control" type="text" id="sdt" name="sdt" required>
                    </div>
                    <div class="form-group">
                        <label for="chuc_vu">Chức vụ</label>
                        <input class="form-control" type="text" id="chuc_vu" name="chuc_vu" required>
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
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
  <script>
    function deleteRow(r) {
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("myTable").deleteRow(i);
    }
    jQuery(function () {
      jQuery(".trash").click(function () {
        swal({
          title: "Cảnh báo",
         
          text: "Bạn có chắc chắn là muốn xóa nhân viên này?",
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
    $('#all').click(function (e) {
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
    var myApp = new function () {
      this.printTable = function () {
        var tab = document.getElementById('sampleTable');
        var win = window.open('', '', 'height=700,width=700');
        win.document.write(tab.outerHTML);
        win.document.close();
        win.print();
      }
    }


    //Modal
    $("#show-emp").on("click", function () {
      $("#ModalUP").modal({ backdrop: false, keyboard: false })
    });
  </script>



<script>
function loadEmployeeData(id) {
    $.ajax({
        url: 'get_employee_data.php', 
        type: 'GET',
        data: {id: id},
        success: function(response) {
            var data = JSON.parse(response);
            $('#employee_id').val(data.id);
            $('#ho_ten').val(data.ho_ten);
            $('#anh_3x4').val(data.anh_3x4);
            $('#dia_chi').val(data.dia_chi);
            $('#ngay_sinh').val(data.ngay_sinh);
            $('#gioi_tinh').val(data.gioi_tinh);
            $('#sdt').val(data.sdt);
            $('#chuc_vu').val(data.chuc_vu);
        }
    });
}
</script>

<!-- Xóa các mục đã chọn -->
<script>
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('input[name="check"]');
    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
});
</script>

<script>
function deleteSelectedEmployees() {
    const selected = [];
    document.querySelectorAll('input[name="check"]:checked').forEach(checkbox => {
        selected.push(checkbox.value);
    });

    if (selected.length === 0) {
        alert("Vui lòng chọn ít nhất một nhân viên để xóa.");
        return;
    }

    if (confirm("Bạn có chắc chắn muốn xóa các nhân viên đã chọn?")) {
        $.ajax({
            url: 'delete_selected_employees.php',
            type: 'POST',
            data: { ids: selected },
            success: function(response) {
                alert('Đã xóa các nhân viên đã chọn thành công!');
                location.reload(); 
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại.');
            }
        });
    }
}
</script>

</body>

</html>