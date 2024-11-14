<!DOCTYPE html>
<html lang="en">
<head>
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

</head>
<?php
include "connect.php";
?>

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
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../images/hay.jpg" width="50px"
        alt="User Image">
      <div>
        <p class="app-sidebar__user-name"><b>Võ Trường</b></p>
        <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
      </div>
    </div>
    <hr>
    <ul class="app-menu">
      <li><a class="app-menu__item haha" href="phan-mem-ban-hang.html"><i class='app-menu__icon bx bx-cart-alt'></i>
          <span class="app-menu__label">POS Bán Hàng</span></a></li>
      <li><a class="app-menu__item " href="index.php"><i class='app-menu__icon bx bx-tachometer'></i><span
            class="app-menu__label">Bảng điều khiển</span></a></li>
      <li><a class="app-menu__item " href="table-data-table.php"><i class='app-menu__icon bx bx-id-card'></i>
          <span class="app-menu__label">Quản lý nhân viên</span></a></li>
      <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-user-voice'></i><span
            class="app-menu__label">Quản lý khách hàng</span></a></li>
      <li><a class="app-menu__item" href="table-data-product.php"><i
            class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
      </li>
      <li><a class="app-menu__item active" href="table-data-oder.php"><i class='app-menu__icon bx bx-task'></i><span
            class="app-menu__label">Quản lý đơn hàng</span></a></li>
      <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Cài
            đặt hệ thống</span></a></li>
    </ul>
  </aside>
    <main class="app-content">
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item">Danh sách đơn hàng</li>
          <li class="breadcrumb-item"><a href="#">Thêm đơn hàng</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Tạo mới đơn hàng</h3>
            <div class="tile-body">
            <form class="row">
                <div class="form-group  col-md-4">
                  <label class="control-label">ID đơn hàng </label>
                  <input class="form-control" type="text"required>
                </div>
                <div class="form-group col-md-4">
                  <label class="control-label">Số điện thoại khách hàng</label>
                  <input class="form-control" type="number-phone" required>
                </div>
               
                <div class="form-group  col-md-4">
                  <label class="control-label">Mã nhân viên</label>
                  <input class="form-control" type="text"required>
                </div>
               
                <div class="form-group  col-md-4">
                  <label class="control-label">Ngày làm đơn hàng</label>
                  <input class="form-control" type="date"required >
                </div>
            
                <div class="form-group col-md-4">
                  <label for="product" class="control-product">Tên sản phẩm</label>
                  <select class="form-control" id="product">
                    <option value=""></option>
                    <option value="">Nước mắm Hương Việt</option>
                    <option value="">Sữa chua lên men YAKULT</option>
                    <option value="">Bánh bao không nhân</option>
                    <option value="">Bánh bao Thọ Phát</option>
                    <option value="">Bánh bao trứng muối</option>
                    <option value="">Bánh Kinh Đô</option>  
                    <option value="">Bột chiên giòn AJI QUICK</option>
                    <option value="">Bột chiên giòn OTOGI</option>
                    <option value="">Bột chiên giòn Vĩnh Thuận</option>
                    <option value="">Bội mì đa dụng </option>
                    <option value="">Cháo dinh dưỡng</option>
                    <option value="">Cháo sườn</option>
                    <option value="">Cháo thịt bằm"</option>
                    <option value="">Cháo thịt bò</option>
                    <option value="">Danisa</option>
                    <option value="">Dầu gội Pantene</option>
                    <option value="">Dầu gội Rejoice</option>
                    <option value="">Dầu gội Sunsilk</option>
                    <option value="">Dầu gội Tresemme</option>
                    <option value="">Gia vị kho cá</option>
                    <option value="">Gia vị kho thịt</option>
                    <option value="">Kẹo cứng</option>
                    <option value="">Kẹo dẻo</option>
                    <option value="">Kẹo dâu</option>
                    <option value="">Mì cay</option>
                    <option value="">Mì lẩu thái</option>
                    <option value="">Mì Ô Ma Chi</option>
                    <option value="">Mì tương đen</option>
                    <option value="">Nước mắm Chinsu cá hồi </option>
                    <option value="">Nước mắn Đệ Nhị</option>
                    <option value="">Nước mắm Nam Ngư</option>
                    <option value="">Nước tương Chinsu</option>
                    <option value="">Nước tương Hương Việt</option>
                    <option value="">Oreo</option>
                    <option value="">Phở bò</option>
                    <option value="">Phở Chinsu</option>
                    <option value="">Phở Đệ Nhất</option>
                    <option value="">Phở xưa nay</option>
                    <option value="">Sữa chua uống men Proby</option>
                    <option value="">Sữa chuối Hàn Quốc</option>
                    <option value="">Sữa đậu nhành Fami</option>
                    <option value="">Sữa hạt đóng hột Thtruemilk</option>
                    <option value="">Sữa hạt đóng hột Vinamilk</option>
                    <option value="">Sữa tắm dưỡng da Srlves</option>
                    <option value="">Sữa tắm Hàn Quốc</option>
                    <option value="">Sữa tắm Hazeline yến mạch</option>
                    <option value="">Sữa tắm Hazeline lựu đỏ</option>
                    <option value="">Sữa tắm Lashe</option>
                    <option value="">Sữa tắm Lifebuoy</option>
                    <option value="">Sữa tươi Vinamilk</option>
                    <option value="">Tương cà Chinsu</option>
                    <option value="">Tương cà Cholimex</option>
                    <option value="">Tương ớt Hàn QUốc</option>
                    <option value="">Xốt gia vị bún bò</option>
                    <option value="">Xúc xích ăn liền</option>
                    <option value="">Xúc xích bò Visan</option>
                    <option value="">Xúc xích Visan</option>
                    <option value="">Xúc xích thịt heo</option>
                   
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label class="productCode" class="control-productCode" >Mã sản phẩm</label>
                  <select class="form-control" id="productCode">
                    <option value=""></option>
                    <option value="">7</option>
                    <option value="">8</option>
                    <option value="">9</option>
                    <option value="">10</option>
                    <option value="">11</option>
                    <option value="">12</option>
                    <option value="">13</option>
                    <option value="">14</option>
                    <option value="">15</option>
                    <option value="">16</option>
                  </select>
                </div>
                <div class="form-group  col-md-4">
                  <label class="control-label">Số lượng</label>
                  <input class="form-control" type="number">
                </div>
                <div class="form-group col-md-4">
                  <label for="paymentMethod" class="control-lpayabel">Phương thức thanh toán</label>
                  <select class="form-control" id="paymentMethod">
                    <option value="">Chọn phương thức thanh toán</option>
                    <option value="cash">Tiền mặt</option>
                    <option value="card">Thẻ ngân hàng</option>
                    <option value="transfer">Chuyển khoản</ption>
                    <option value="momo">Ví MoMo</option>
                  </select>
                </div>
                <div class="form-group  col-md-4">
                  <label class="control-label">Ghi chú đơn hàng</label>
                  <textarea class="form-control" rows="4" ></textarea>
                </div>  
             </form> 

          </div>
          <button class="btn btn-save" type="button">Lưu lại</button>
          <!-- <button type="submit">Lưa</button> -->
          <a class="btn btn-cancel" href="/doc/table-data-oder.php">Hủy bỏ</a>
        </div>
    </main>
    <?php
include "connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{
        // Lấy dữ liệu từ form
        $MaHoaDon = $_POST[' MaHoaDon'];
        $MaNV = $_POST['MaNV'];
        $NgayLap = $_POST['NgayLap'];
        $MaPTTT = $_POST['MaPTTT'];
        $TongTien= $_POST['TongTien'];
        $MaKH =$_POST ['MaKH'];
       
            
        $stmthoadon = $conn->prepare("INSERT INTO hoadon (MaHoaDon, MaNV, NgayLap, MaPTTT,TongTien,MaKH)  VALUES (?, ?,?,?,?,?)");
        $stmthoadon->bind_param("sssssss", $MaHoaDon, $MaNV, $NgayLap, $MaPTTT,$TongTien,$MaKH);
        /*$stmt->execute();*/
    
        if ($stmthoadon->execute()){
          echo("Kết nối thất bại: " . $stmthoadon_error);
        }else{
          echo "kn thành công";
        }

        // Validate dữ liệu
        if (empty($MaHoaDon) || empty($MaNV) || empty($NgayLap) || empty($MaPTTT)) {
            throw new Exception("Vui lòng điền đầy đủ thông tin bắt buộc!");
        }

        // Bắt đầu transaction
        $conn->begin_transaction();
        /*if ($stmt->execute()) {
            echo "Sản phẩm mới đã được thêm thành công.";
        }*/

        // Thêm hóa đơn
        /*$sql_hoadon = "INSERT INTO hoadon (MaHoaDon, MaNV, NgayLap, MaPTTT,TongTien,MaKH) 
                       VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $conn->prepare($sql_hoadon);
        $stmt->bind_param("ssssss", $MaHoaDon, $MaNV, $NgayLap, $MaPTTT,$TongTien,$MaKH);
        $stmt->execute();*/
        
        // Thêm chi tiết hóa đơn
        if (!empty($maSP) && !empty($SoLuong)) {
            $sql_chitiet = "INSERT INTO chitiethoadoon (MaCTHD, MaHoaDon,MaSP,SoLuong,DonGia) 
                           VALUES (? ,?, ?, ?, ?)";
            $stmt_chitiet = $conn->prepare($sql_chitiet);
            $stmt_chitiet->bind_param("sii", $MaCTHD,$MaHoaDon, $MaSP, $SoLuong,$DonGia);
            $stmt_chitiet->execute();
            if($stmt_chitiet->execute()){
              echo "Lỗi khi thêm hóa đơn: " . $stmthoadon->error;
              $conn->rollback();
            }
            
            // Cập nhật số lượng sản phẩm
            $sql_update = "UPDATE sanpham SET SoLuong = SoLuong - ? WHERE MaSP = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("ii", $soLuong, $maSP);
            $stmt_update->execute();
        }

        $conn->commit();
        header("Location: table-data-oder.php");
        exit();
    
      } catch (Exception $e){
        echo "Lỗi:".$e->getMessage();
        $conn->rollback(); 
        /*$error = $e->getMessage();*/
      }
  }
      
// Lấy danh sách sản phẩm cho dropdown
   $sql_sanpham = "SELECT MaSP, TenSP FROM sanpham";
   $result_products = $conn->query($sql_products);    
  ?>
   <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <script>
    // Object chứa thông tin sản phẩm
  /*const productDetails = {
  'Nước mắm Hương Việt': { code: 'NM001' },
  'Sữa chua lên men YAKULT': { code: 'SC001' },
  'Bánh bao không nhân': { code: 'BB001' },
  // Thêm các sản phẩm khác vào đây...
}*/

// Khởi tạo mảng chứa các sản phẩm đã chọn
let selectedProducts = [];
document.addEventListener('DOMContentLoaded', function() {
  const addProductBtn = document.getElementById('addProduct');
  const productSelect = document.getElementById('product');
  const productTable = document.getElementById('productTable').getElementsByTagName('tbody')[0];
  
  // Sự kiện click nút thêm sản phẩm
  addProductBtn.addEventListener('click', function() {
    const selectedProduct = productSelect.value;
    const productCode = productDetails[selectedProduct]?.code || generateProductCode();
    const quantity = document.querySelector('input[type="number"]').value || 1;
    
    if (selectedProduct) {
      // Thêm sản phẩm vào mảng
      selectedProducts.push({
        name: selectedProduct,
        code: productCode,
        quantity: quantity
      });
      
      // Thêm sản phẩm vào bảng
      const newRow = productTable.insertRow();
      newRow.innerHTML = `
        <td>${selectedProduct}</td>
        <td>${productCode}</td>
        <td>${quantity}</td>
        <td>
          <button type="button" class="btn btn-danger btn-sm" onclick="removeProduct(this)">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      `;
      
      // Reset form
      productSelect.value = '';
      document.querySelector('input[type="number"]').value = '';
    } else {
      swal({
        title: "Lỗi!",
        text: "Vui lòng chọn sản phẩm",
        icon: "error",
        button: "OK",
      });
    }
  });
});

// Hàm xóa sản phẩm
function removeProduct(button) {
  const row = button.closest('tr');
  const index = row.rowIndex - 1;
  selectedProducts.splice(index, 1);
  row.remove();
}

// Hàm tạo mã sản phẩm ngẫu nhiên nếu không có trong danh sách
function generateProductCode() {
  return 'SP' + Math.floor(Math.random() * 10000).toString().padStart(4, '0');
}

// Sửa lại sự kiện submit form
document.querySelector('.btn-save').addEventListener('click', function(e) {
  e.preventDefault();
  
  // Kiểm tra các trường bắt buộc
  const requiredInputs = document.querySelectorAll('.form-control[required]');
  let isValid = true;
  
  requiredInputs.forEach(input => {
    if (!input.value.trim()) {
      isValid = false;
      input.classList.add('is-invalid');
    } else {
      input.classList.remove('is-invalid');
    }
  });
  
  // Kiểm tra có sản phẩm nào được chọn chưa
  //if (selectedProducts.length === 0) 
  /*{
    isValid = false;
    swal({
      title: "Lỗi!",
      text: "Vui lòng thêm ít nhất một sản phẩm",
      icon: "error",
      button: "OK",
    });
    return;
  }*/
  
  if (!isValid) {
    swal({
      title: "Lỗi!",
      text: "Vui lòng điền đầy đủ thông tin đơn hàng",
      icon: "error",
      button: "OK",
    });
    return;
  }
  
  // Xử lý lưu đơn hàng
  swal({
    title: "Thành công!",
    text: "Đã tạo đơn hàng mới thành công",
    icon: "success",
    button: "OK",
  }).then((value) => {
    if (value) {
      window.location.href = "table-data-oder.php";
    }
  });
});
</script>
  </body>
</html>