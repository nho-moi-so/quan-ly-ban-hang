<!DOCTYPE html>
<html lang="en">

<head>
  <title>Thêm nhân viên | Quản trị Admin</title>
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
  <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <script>

    function readURL(input, thumbimage) {
      if (input.files && input.files[0]) { //Sử dụng  cho Firefox - chrome
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#thumbimage").attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
      else { // Sử dụng cho IE
        $("#thumbimage").attr('src', input.value);

      }
      $("#thumbimage").show();
      $('.filename').text($("#uploadfile").val());
      $('.Choicefile').css('background', '#14142B');
      $('.Choicefile').css('cursor', 'default');
      $(".removeimg").show();
      $(".Choicefile").unbind('click');

    }
    $(document).ready(function () {
      $(".Choicefile").bind('click', function () {
        $("#uploadfile").click();

      });
      $(".removeimg").click(function () {
        $("#thumbimage").attr('src', '').hide();
        $("#myfileupload").html('<input type="file" id="uploadfile"  onchange="readURL(this);" />');
        $(".removeimg").hide();
        $(".Choicefile").bind('click', function () {
          $("#uploadfile").click();
        });
        $('.Choicefile').css('background', '#14142B');
        $('.Choicefile').css('cursor', 'pointer');
        $(".filename").text("");
      });
    })
  </script>
</head>

<body class="app sidebar-mini rtl">
  <style>
    .Choicefile {
      display: block;
      background: #14142B;
      border: 1px solid #fff;
      color: #fff;
      width: 150px;
      text-align: center;
      text-decoration: none;
      cursor: pointer;
      padding: 5px 0px;
      border-radius: 5px;
      font-weight: 500;
      align-items: center;
      justify-content: center;
    }

    .Choicefile:hover {
      text-decoration: none;
      color: white;
    }

    #uploadfile,
    .removeimg {
      display: none;
    }

    #thumbbox {
      position: relative;
      width: 100%;
      margin-bottom: 20px;
    }

    .removeimg {
      height: 25px;
      position: absolute;
      background-repeat: no-repeat;
      top: 5px;
      left: 5px;
      background-size: 25px;
      width: 25px;
      /* border: 3px solid red; */
      border-radius: 50%;

    }

    .removeimg::before {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      content: '';
      border: 1px solid red;
      background: red;
      text-align: center;
      display: block;
      margin-top: 11px;
      transform: rotate(45deg);
    }

    .removeimg::after {
      /* color: #FFF; */
      /* background-color: #DC403B; */
      content: '';
      background: red;
      border: 1px solid red;
      text-align: center;
      display: block;
      transform: rotate(-45deg);
      margin-top: -2px;
    }
  </style>


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
      <li><a class="app-menu__item haha" href="phan-mem-ban-hang.html"><i class='app-menu__icon bx bx-cart-alt'></i>
          <span class="app-menu__label">POS Bán Hàng</span></a></li>
      <li><a class="app-menu__item " href="index.php"><i class='app-menu__icon bx bx-tachometer'></i><span
            class="app-menu__label">Bảng điều khiển</span></a></li>
      <li><a class="app-menu__item active" href="table-data-table.php"><i class='app-menu__icon bx bx-id-card'></i>
          <span class="app-menu__label">Quản lý nhân viên</span></a></li>
      <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-user-voice'></i><span
            class="app-menu__label">Quản lý khách hàng</span></a></li>
      <li><a class="app-menu__item" href="table-data-product.php"><i
            class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
      </li>
      <li><a class="app-menu__item" href="table-data-oder.html"><i class='app-menu__icon bx bx-task'></i><span
            class="app-menu__label">Quản lý đơn hàng</span></a></li>
      <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Cài
            đặt hệ thống</span></a></li>
    </ul>
  </aside>



<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $ho_ten = $_POST['ho_ten'];
  $email = $_POST['email'];
  $dia_chi = $_POST['dia_chi'];
  $sdt = $_POST['sdt'];
  $ngay_sinh = $_POST['ngay_sinh'];
  $noi_sinh = $_POST['noi_sinh'];
  $cmnd = $_POST['cmnd'];
  $ngay_cap = $_POST['ngay_cap'];
  $noi_cap = $_POST['noi_cap'];
  $gioi_tinh = $_POST['gioi_tinh'];
  $chuc_vu = $_POST['chuc_vu'];
  $bang_cap = $_POST['bang_cap'];
  $tinh_trang_hon_nhan = $_POST['tinh_trang_hon_nhan'];

  $upload_dir = "../img-anhthe/uploads/";
  $file_name = basename($_FILES['anh_3x4']['name']);
  $file_tmp = $_FILES['anh_3x4']['tmp_name'];
  $file_path = $upload_dir . $file_name;

  if (isset($_FILES['anh_3x4']) && $_FILES['anh_3x4']['error'] == UPLOAD_ERR_OK) {
    if (move_uploaded_file($file_tmp, $file_path)) {
      $anh_3x4 = $file_path;
    } else {
      $anh_3x4 = NULL;
        echo "<script>alert('Không thể tải ảnh lên.');</script>";
      }
    } else {
      $anh_3x4 = NULL;
      echo "<script>alert('Lỗi khi tải ảnh lên.');</script>";
    }

    $sql = "INSERT INTO nhanvien (ho_ten, email, dia_chi, sdt, ngay_sinh, noi_sinh, cmnd, ngay_cap, noi_cap, gioi_tinh, chuc_vu, bang_cap, tinh_trang_hon_nhan, anh_3x4)
            VALUES ('$ho_ten', '$email', '$dia_chi', '$sdt', '$ngay_sinh', '$noi_sinh', '$cmnd', '$ngay_cap', '$noi_cap', '$gioi_tinh', '$chuc_vu', '$bang_cap', '$tinh_trang_hon_nhan', '$anh_3x4')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm nhân viên thành công!'); window.location.href='table-data-table.php';</script>";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">Danh sách nhân viên</li>
            <li class="breadcrumb-item"><a href="#">Thêm nhân viên</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Tạo mới nhân viên</h3>
                <div class="tile-body">
                    <div class="row element-button">
                        
                    </div>
                    <form class="row" method="POST" enctype="multipart/form-data">
                        <div class="form-group col-md-4">
                            <label class="control-label">ID nhân viên</label>
                            <input class="form-control" type="text" name="id_nhan_vien">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Họ và tên</label>
                            <input class="form-control" type="text" name="ho_ten" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Địa chỉ email</label>
                            <input class="form-control" type="email" name="email" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Địa chỉ thường trú</label>
                            <input class="form-control" type="text" name="dia_chi" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Số điện thoại</label>
                            <input class="form-control" type="number" name="sdt" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label">Ngày sinh</label>
                            <input class="form-control" type="date" name="ngay_sinh">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Nơi sinh</label>
                            <input class="form-control" type="text" name="noi_sinh" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Số CMND</label>
                            <input class="form-control" type="number" name="cmnd" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Ngày cấp</label>
                            <input class="form-control" type="date" name="ngay_cap" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Nơi cấp</label>
                            <input class="form-control" type="text" name="noi_cap" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Giới tính</label>
                            <select class="form-control" name="gioi_tinh" required>
                                <option>-- Chọn giới tính --</option>
                                <option>Nam</option>
                                <option>Nữ</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Chức vụ</label>
                            <select class="form-control" name="chuc_vu">
                                <option>-- Chọn chức vụ --</option>
                                <option>Bán hàng</option>
                                <option>Tư vấn</option>
                                <option>Dịch vụ</option>
                                <option>Thu Ngân</option>
                                <option>Quản kho</option>
                                <option>Bảo trì</option>
                                <option>Kiểm hàng</option>
                                <option>Bảo vệ</option>
                                <option>Tạp vụ</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Bằng cấp</label>
                            <select class="form-control" name="bang_cap">
                                <option>-- Chọn bằng cấp --</option>
                                <option>Tốt nghiệp Đại Học</option>
                                <option>Tốt nghiệp Cao Đẳng</option>
                                <option>Tốt nghiệp Phổ Thông</option>
                                <option>Chưa tốt nghiệp</option>
                                <option>Không bằng cấp</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Tình trạng hôn nhân</label>
                            <select class="form-control" name="tinh_trang_hon_nhan">
                                <option>-- Chọn tình trạng hôn nhân --</option>
                                <option>Độc thân</option>
                                <option>Đã kết hôn</option>
                                <option>Góa</option>
                                <option>Khác</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Ảnh 3x4 nhân viên</label>
                            <input type="file" name="anh_3x4" class="form-control" accept="image/*" />
                        </div>
                        <button class="btn btn-save" type="submit">Lưu lại</button>
                        <a class="btn btn-cancel" href="/doc/table-data-table.php">Hủy bỏ</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


  <!--MODAL-->


  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>





</body>

</html>