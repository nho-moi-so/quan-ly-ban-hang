<?php
include "connect.php";
?>
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
  
                  <a class="btn btn-add btn-sm" href="./form-add-don-hang.php" title="Thêm"><i class="fas fa-plus"></i>
                    Tạo mới đơn hàng</a>
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
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th width="10"><input type="checkbox" id="all"></th>
                    <th>ID đơn hàng</th>
                    <th>Khách hàng</th>
                    <th>Đơn hàng</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Tình trạng</th>
                    <th>Tính năng</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                    <td width="10"><input type="checkbox" name="check1" value="1"></td>
                    <td>MD0837</td>
                    <td>Triệu Thanh Phú</td>
                    <td>Ghế làm việc Zuno, Bàn ăn gỗ Theresa</td>
                    <td>2</td>
                    <td>9.400.000 đ</td>
                    <td><span class="badge bg-success">Hoàn thành</span></td>
                    <td><button class="btn btn-primary btn-sm trash" type="button" title="Xóa"><i class="fas fa-trash-alt"></i> </button>
                      <button class="btn btn-primary btn-sm edit" type="button" title="Sửa"><i class="fa fa-edit"></i></button></td>
                  </tr>
                  <tr>
                    <td width="10"><input type="checkbox" name="check1" value="1"></td>
                    <td>MD0837</td>
                    <td>Triệu Thanh Phú</td>
                    <td>Ghế làm việc Zuno, Bàn ăn gỗ Theresa</td>
                    <td>2</td>
                    <td>9.400.000 đ</td>
                    <td><span class="badge bg-success">Hoàn thành</span></td>
                    <td><button class="btn btn-primary btn-sm trash" type="button" title="Xóa"><i class="fas fa-trash-alt"></i> </button>
                      <button class="btn btn-primary btn-sm edit" type="button" title="Sửa"><i class="fa fa-edit"></i></button></td>
                  </tr>
                  <tr>
                    <td width="10"><input type="checkbox" name="check1" value="1"></td>
                    <td>MD0837</td>
                    <td>Triệu Thanh Phú</td>
                    <td>Ghế làm việc Zuno, Bàn ăn gỗ Theresa</td>
                    <td>2</td>
                    <td>9.400.000 đ</td>
                    <td><span class="badge bg-success">Hoàn thành</span></td>
                    <td><button class="btn btn-primary btn-sm trash" type="button" title="Xóa"><i class="fas fa-trash-alt"></i> </button>
                      <button class="btn btn-primary btn-sm edit" type="button" title="Sửa"><i class="fa fa-edit"></i></button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php
// Kết nối database
require_once 'connect.php';

// Function lấy trạng thái đơn hàng
function getOrderStatus($status) {
    switch($status) {
        case 1:
            return '<span class="badge bg-success">Hoàn thành</span>';
        case 2:
            return '<span class="badge bg-warning">Đang xử lý</span>';
        case 3:
            return '<span class="badge bg-danger">Đã hủy</span>';
        default:
            return '<span class="badge bg-info">Mới</span>';
    }
}

// Function format tiền tệ
function formatMoney($amount) {
    return number_format($amount, 0, ',', '.') . ' đ';
}

// Xử lý xóa đơn hàng
if(isset($_POST['delete_order'])) {
    $order_id = $_POST['order_id'];
    $delete_sql = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("s", $order_id);
    if($stmt->execute()) {
        $_SESSION['success'] = "Xóa đơn hàng thành công";
    } else {
        $_SESSION['error'] = "Xóa đơn hàng thất bại";
    }
}

// Lấy danh sách đơn hàng
$sql = "SELECT o.*, c.customer_name, 
        GROUP_CONCAT(p.product_name SEPARATOR ', ') as products,
        SUM(od.quantity) as total_quantity,
        SUM(od.quantity * od.price) as total_amount
        FROM orders o
        LEFT JOIN customers c ON o.customer_id = c.id
        LEFT JOIN order_details od ON o.id = od.order_id
        LEFT JOIN products p ON od.product_id = p.id
        GROUP BY o.id
        ORDER BY o.created_at DESC";

$result = $conn->query($sql);
?>

<!-- Hiển thị thông báo -->
<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?php 
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        ?>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?php 
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        ?>
    </div>
<?php endif; ?>

<!-- Phần hiển thị bảng dữ liệu -->
<table class="table table-hover table-bordered" id="sampleTable">
    <!-- <thead>
        <tr>
            <th width="10"><input type="checkbox" id="all"></th>
            <th>ID đơn hàng</th>
            <th>Khách hàng</th>
            <th>Đơn hàng</th>
            <th>Số lượng</th>
            <th>Tổng tiền</th>
            <th>Tình trạng</th>
            <th>Tính năng</th>
        </tr>
    </thead> -->
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td width="10"><input type="checkbox" name="check1" value="<?php echo $row['id']; ?>"></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['MaKKH']); ?></td>
            <td><?php echo htmlspecialchars($row['SanPham']); ?></td>
            <td><?php echo $row['DonGia']; ?></td>
            <td><?php echo formatMoney($row['total_amount']); ?></td>
            <td><?php echo getOrderStatus($row['status']); ?></td>
            <td>
                <button class="btn btn-primary btn-sm trash" type="button" title="Xóa"
                    onclick="deleteOrder('<?php echo $row['id']; ?>')">
                    <i class="fas fa-trash-alt"></i>
                </button>
                <a href="edit-order.php?id=<?php echo $row['id']; ?>" 
                   class="btn btn-primary btn-sm edit" title="Sửa">
                    <i class="fa fa-edit"></i>
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Script xử lý -->
<script>
// Xử lý check all
document.getElementById('all').onclick = function() {
    var checkboxes = document.getElementsByName('check1');
    for(var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}

// Function xóa đơn hàng
function deleteOrder(orderId) {
    swal({
        title: "Cảnh báo",
        text: "Bạn có chắc chắn muốn xóa đơn hàng này?",
        buttons: ["Hủy bỏ", "Đồng ý"],
    })
    .then((willDelete) => {
        if (willDelete) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '';

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_order';
            input.value = '1';
            form.appendChild(input);

            var input2 = document.createElement('input');
            input2.type = 'hidden';
            input2.name = 'order_id';
            input2.value = orderId;
            form.appendChild(input2);

            document.body.appendChild(form);
            form.submit();
        }
    });
}

// Xử lý xuất Excel
$('.btn-excel').click(function(e){
    e.preventDefault();
    $("#sampleTable").table2excel({
        exclude: ".noExl",
        name: "Excel Document Name",
        filename: "DanhSachDonHang",
        fileext: ".xls",
        exclude_img: true,
        exclude_links: true,
        exclude_inputs: true
    });
});

// Xử lý in dữ liệu
var myApp = new function () {
    this.printTable = function () {
        var tab = document.getElementById('sampleTable');
        var win = window.open('', '', 'height=700,width=700');
        win.document.write(tab.outerHTML);
        win.document.close();
        win.print();
    }
}
</script>
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
</body>
</html>

