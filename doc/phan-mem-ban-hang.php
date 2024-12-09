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

<body onload="time()" class="app sidebar-mini rtl">
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
                <input type="text" id="myInput" name="search" class="form-control" placeholder="Nhập mã sản phẩm hoặc tên sản phẩm để tìm kiếm..."class="form-control mr-2">
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
                .btn-primary {
                    margin-left: 10px;
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
                                    <td><?= number_format($row['DonGia'], 0, ',', '.') ?></td>
                                    <td>
                                        <button class="btn btn-success btn-sm add-to-cart" 
                                                data-id="<?= $row['MaSP'] ?>" 
                                                data-name="<?= $row['TenSP'] ?>" 
                                                data-price="<?= $row['DonGia'] ?>" 
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
            <!-- <div class="text-right">
                <h5 class="mt-3">Tổng tiền: <span id="total-amount">0</span> VND</h5>
            </div> -->
        </div>
        
        <div class="alert">
            <i class="fas fa-exclamation-triangle"></i> Gõ mã hoặc tên sản phẩm vào thanh tìm kiếm để thêm hàng vào đơn hàng
        </div>
    </div>
</div>

<!------------------------------ THONG TIN THANH TOAN ---------------------------------->
            <?php
            include 'connect.php';

            $khachhang = null;
            if (isset($_GET['sdt'])) {
                $sdt = $_GET['sdt'];
                $sql_khachhang = "SELECT TenKH FROM khachhang WHERE DienThoai = '$sdt'";
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
                            <input class="form-control" type="text" id="sdt" placeholder="Tìm kiếm khách hàng">
                        </div>
                        <div class="form-group col-md-2">
                            <label style="text-align: center;" class="control-label">Tìm</label>
                            <button class="btn btn-primary btn-timkiem" onclick="searchCustomer()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div class="form-group col-md-10">
                            <small class="text-danger"></small>
                        </div>
                        <style>
                            .text-danger{
                                font-size: 14px;
                            }
                        </style>
                        <div class="form-group col-md-12">
                            <?php if ($khachhang): ?>
                                <small class="text-success">Họ và tên: <?php echo $khachhang['TenKH']; ?></small>
                            <?php elseif (isset($_GET['sdt']) && !$khachhang): ?>
                                <small class="text-danger">Không tìm thấy thông tin khách hàng với số điện thoại này.</small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group col-md-2">
                            <label style="text-align: center;" class="control-label">Tạo mới</label>
                            <button class="btn btn-primary btn-them" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Nhân viên bán hàng</label>
                            <select class="form-control" id="exampleSelect1">
                                <option>--- Chọn nhân viên bán hàng ---</option>
                                <?php while ($row = $result_nhanvien->fetch_assoc()): ?>
                                    <option value="<?php echo $row['id']; ?>">
                                        <?php echo $row['id'] . '-' . $row['ho_ten']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Ghi chú đơn hàng</label>
                            <textarea class="form-control" rows="4" placeholder="Ghi chú thêm đơn hàng"></textarea>
                        </div>
                    </div>
<!----------------------------------------- HÌNH THỨC THANH TOÁN ----------------------------------------->
                    <?php
                    include 'connect.php';

                    $tamtinh = 0;
                    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                        foreach ($_SESSION['cart'] as $item) {
                            $soLuong = isset($item['quantity']) ? $item['quantity'] : 0;
                            $donGia = isset($item['DonGia']) ? $item['DonGia'] : 0;
                            $tamtinh += $soLuong * $donGia;
                        }
                    }
                    $tongcong = $tamtinh;

                    // $khachhang_dua_tien = isset($_POST['khachhang_dua_tien']) ? $_POST['khachhang_dua_tien'] : 0;
                    // $khachhang_thoi = $khachhang_dua_tien - $tongcong;

                    $sql_phuongthucthanhtoan = "SELECT * FROM phuongthucthanhtoan";
                    $result_phuongthucthanhtoan = $conn->query($sql_phuongthucthanhtoan);

                    $khachhang = null;
                    if (isset($_GET['sdt'])) {
                        $sdt = $conn->real_escape_string($_GET['sdt']);
                        $sql_khachhang = "SELECT * FROM khachhang WHERE DienThoai = '$sdt'";
                        $result_khachhang = $conn->query($sql_khachhang);
                        $khachhang = ($result_khachhang && $result_khachhang->num_rows > 0) ? $result_khachhang->fetch_assoc() : null;
                    }

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hinhthucthanhtoan']) && isset($_POST['khachhang_dua_tien'])) {
                        $maKH = isset($khachhang['MaKH']) ? $khachhang['MaKH'] : 'NULL';
                        $maNV = 1;
                        $ngayBan = date('Y-m-d H:i:s');
                        $phuongThucThanhToan = $_POST['hinhthucthanhtoan'];
                        $tongTien = $tongcong;

                        $sql = "INSERT INTO donhang (khach_hang, ngay_ban, tong_tien) 
                                VALUES ('$maKH', '$ngayBan', '$tongTien')";

                        if ($conn->query($sql) === TRUE) {
                            $maDonHang = $conn->insert_id;
                            $ngayHienTai = date('Ymd');
                            $soThuTu = str_pad($maDonHang, 3, '0', STR_PAD_LEFT);
                            $maDonHangFormatted = "DH-" . $ngayHienTai . "-" . $soThuTu;

                            $sqlUpdate = "UPDATE donhang SET ma_don_hang = '$maDonHangFormatted' WHERE id_don_hang = $maDonHang";
                            $conn->query($sqlUpdate);

                            foreach ($_SESSION['cart'] as $item) {
                                $maSP = $conn->real_escape_string($item['MaSP']);
                                $soLuong = isset($item['quantity']) ? $item['quantity'] : 0;
                                $giaBan = isset($item['DonGia']) ? $item['DonGia'] : 0;

                                $sqlCTHD = "INSERT INTO chitiethoadon (MaHD, MaSP, SoLuong, GiaBan) 
                                            VALUES ('$maDonHang', '$maSP', '$soLuong', '$giaBan')";
                                $conn->query($sqlCTHD);
                            }

                            if ($phuongThucThanhToan == "Chuyển khoản") {
                                $soTaiKhoan = $conn->real_escape_string($_POST['so_tai_khoan']);
                                $ngayChuyenKhoan = $conn->real_escape_string($_POST['ngay_chuyen_khoan']);
                                $soTienChuyenKhoan = $conn->real_escape_string($_POST['so_tien_chuyen_khoan']);

                                $sqlChuyenKhoan = "INSERT INTO chuyenkhoan (MaKH, SoTaiKhoan, NgayChuyenKhoan, SoTienChuyenKhoan) 
                                                    VALUES ('$maKH', '$soTaiKhoan', '$ngayChuyenKhoan', '$soTienChuyenKhoan')";
                                $conn->query($sqlChuyenKhoan);
                            }

                            if ($phuongThucThanhToan == "Tiền mặt") {
                                $soTienNhan = $conn->real_escape_string($_POST['khachhang_dua_tien']);
                                $soTienThua = $soTienNhan - $tongTien;

                                $sqlTienMat = "INSERT INTO thongtintienmat (SotienNhan, SoTienThua, MaKH) 
                                                VALUES ('$soTienNhan', '$soTienThua', '$maKH')";
                                $conn->query($sqlTienMat);
                            }

                            $diemTichLuy = $tongTien * 0.01;
                            $sql_get_diem = "SELECT DiemTichLuy FROM khachhang WHERE MaKH = '$maKH'";
                            $result_diem = $conn->query($sql_get_diem);
                            $diemTichLuyHienTai = ($result_diem && $result_diem->num_rows > 0) ? $result_diem->fetch_assoc()['DiemTichLuy'] : 0;
                            $newDiemTichLuy = $diemTichLuyHienTai + $diemTichLuy;

                            $sql_update_diem = "UPDATE khachhang 
                                                SET DiemTichLuy = $newDiemTichLuy 
                                                WHERE MaKH = '$maKH'";
                            $conn->query($sql_update_diem);

                            echo "<script> alert('Đơn hàng đã được lưu thành công!');
                                    window.location.href = 'table-data-oder.php';
                                </script>";
                        } else {
                            echo "<script>alert('Lỗi khi lưu đơn hàng: " . $conn->error . "');</script>";
                        }
                    }

                    $conn->close();
                    ?>

                    <form method="POST" id="orderForm">
                        <div class="form-group col-md-12">
                            <label class="control-label">Mã đơn hàng</label>
                            <input class="form-control" type="text" id="ma_don_hang" name="ma_don_hang" value="<?php echo isset($maDonHang) ? $maDonHang : ''; ?>" readonly>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="control-label">Hình thức thanh toán</label><br>
                            <input type="radio" id="tienmat" name="hinhthucthanhtoan" value="Tiền mặt" required>
                            <label for="tienmat">Tiền mặt</label><br>
                            <input type="radio" id="chuyenkhoan" name="hinhthucthanhtoan" value="Chuyển khoản" required>
                            <label for="chuyenkhoan">Chuyển khoản</label><br>
                        </div>

                        <div id="chuyen_khoan_fields" style="display:none;">
                            <div class="form-group col-md-12">
                                <label class="control-label">Số tài khoản</label>
                                <input class="form-control" type="text" name="so_tai_khoan" id="so_tai_khoan">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Ngày chuyển khoản</label>
                                <input class="form-control" type="date" name="ngay_chuyen_khoan" id="ngay_chuyen_khoan">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Số tiền chuyển khoản</label>
                                <input class="form-control" type="text" name="so_tien_chuyen_khoan" id="so_tien_chuyen_khoan">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Tạm tính tiền hàng: </label>
                            <p class="control-all-money-tamtinh">= <?php echo number_format($tamtinh, 0, ',', '.'); ?> VNĐ</p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Tổng cộng thanh toán: </label>
                            <p class="control-all-money-total">= <?php echo number_format($tongcong, 0, ',', '.'); ?> VNĐ</p>
                        </div>
                        <div class="col-md-5">
                            <label class="control-label">Tiền nhận: </label>
                            <input class="form-control" type="text" id="khachhang_dua_tien" name="khachhang_dua_tien">
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button type="button" class="btn btn-info" id="tinh_tien_thoi">Tính tiền thối</button>
                        </div>
                        <style>
                            .btn-info{
                                margin-top: 10px;
                            }
                        </style>
                        <div class="col-md-5">
                            <label class="control-label">Tiền thừa: </label>
                            <p id="tienso" class="control-all-money">= 0 VNĐ</p>
                        </div>
                        <div class="col-md-12">
                            <p style="color: red;"><?php echo isset($thongbao) ? $thongbao : ''; ?></p>
                        </div>

                        <div class="tile-footer col-md-12">
                            <button class="btn btn-primary luu-san-pham" type="submit">Lưu đơn hàng</button>
                            <button class="btn btn-primary luu-va-in" type="submit">In hóa đơn</button>
                            <a class="btn btn-secondary luu-va-in" href="index.php">Quay về</a>
                        </div>
                    </form>

                    <script>
                        document.querySelectorAll('input[name="hinhthucthanhtoan"]').forEach((elem) => {
                            elem.addEventListener('change', function() {
                                if (this.value == 'Chuyển khoản') {
                                    document.getElementById('chuyen_khoan_fields').style.display = 'block';
                                } else {
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
            $maKHFormatted = 'KH-' . strtoupper(bin2hex(random_bytes(4)));

            $check_sdt = $conn->prepare("SELECT * FROM khachhang WHERE DienThoai = ?");
            $check_sdt->bind_param("s", $dien_thoai);
            $check_sdt->execute();
            $result = $check_sdt->get_result();

            if ($result->num_rows > 0) {
                echo "<script>alert('Số điện thoại này đã tồn tại trong hệ thống!');</script>";
            } else {
                $sql_insert = $conn->prepare("INSERT INTO khachhang (MaKH, TenKH, DienThoai, NgayLap) VALUES (?, ?, ?, ?)");
                $sql_insert->bind_param("ssss", $maKHFormatted, $ten_kh, $dien_thoai, $ngay_them);

                if ($sql_insert->execute()) {
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "<script>alert('Lỗi: " . $conn->error . "');</script>";
                }
            }

            $check_sdt->close();
        } else {
            echo "<script>alert('Vui lòng điền đầy đủ thông tin!');</script>";
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
                                <input class="form-control" type="text" name="ma_kh" value="<?php echo isset($maKHFormatted) ? $maKHFormatted : ''; ?>" readonly>
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
    <script type="text/javascript">
        $('#sampleTable').DataTable();
    </script>
    <script>
        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            document.getElementById("myTable").deleteRow(i);
        }
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
            tmp = '<span class="date"> <i class="bx bxs-calendar" ></i> ' + today + ' | <i class="fa fa-clock-o" aria-hidden="true"></i>  : ' + nowTime +
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
                        text: "Bạn có chắc chắn là muốn xóa?",
                        buttons: ["Đóng", "Đồng ý"],
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Đã xóa thành công.!", {});
                        }
                    });
            });
        });
    </script>
    <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
$(document).ready(function(){
    // Thêm sản phẩm vào giỏ hàng
    $('form.add-to-cart-form').submit(function(e){
        e.preventDefault();        
        var formData = $(this).serialize();        
        $.ajax({
            type: 'POST',
            url: '',  
            data: formData,
            success: function(response) {
                loadCart();  
            },
            error: function() {
                alert('Đã xảy ra lỗi khi thêm sản phẩm!');
            }
        });
    });

    // Xóa sản phẩm khỏi giỏ hàng
    $('form.remove-from-cart-form').submit(function(e){
        e.preventDefault();  
        var formData = $(this).serialize();        
        $.ajax({
            type: 'POST',
            url: '',  
            data: formData,
            success: function(response) {

                loadCart();  
            },
            error: function() {
                alert('Đã xảy ra lỗi khi xóa sản phẩm!');
            }
        });
    });
    function loadCart() {
        $.ajax({
            url: 'load_cart.php',  
            success: function(response) {
                $('.cart-section').html(response);  
            }
        });
    }
});
</script> -->

<!--------------------------- tìm kiếm khách hàng -------------------------------------->
    <script>
        function getCustomerName() {
            const sdt = document.getElementById("sdt").value;

            if (sdt.length >= 10) {
                fetch(`fetch_customer.php?sdt=${sdt}`)
                    .then(response => response.json())
                    .then(data => {
                        const messageBox = document.querySelector("#customerMessage");
                        if (data.success) {
                            messageBox.innerHTML = `<small class="text-success">${data.data.ho_ten}</small>`;
                        } else {
                            messageBox.innerHTML = `<small class="text-danger">${data.message}</small>`;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching customer:', error);
                    });
            }
        }
    </script>
    <script>
        function searchCustomer() {
            const sdt = document.getElementById('sdt').value;
            if (sdt.trim() === '') {
                alert('Vui lòng nhập số điện thoại để tìm kiếm.');
                return;
            }
            window.location.href = `?sdt=${sdt}`;
        }
    </script>


<script>
    function searchCustomer() {
    const sdt = document.getElementById('sdt').value;

    if (!sdt) {
        alert('Vui lòng nhập số điện thoại');
        return;
    }

    fetch('search_customer.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `sdt=${encodeURIComponent(sdt)}`
    })
        .then(response => response.json())
        .then(data => {
            const resultContainer = document.querySelector('.form-group.col-md-12 .text-success, .text-danger');

            if (data.status === 'success') {
                resultContainer.innerHTML = `Họ và tên: <small class="text-success">${data.TenKH}</small>`;
            } else {
                resultContainer.innerHTML = `<small class="text-danger">${data.message}</small>`;
            }
        })
        .catch(error => console.error('Error:', error));
}

</script>
<!------------------------------ tim kiem va gio hang  -------------------------------->
<script>

$(document).ready(function() {
    const cartList = $('#cart-list');
    const totalAmount = $('#total-amount');
    const productSection = $('#product-section');
    const productList = $('#product-list');
    const alertMessage = $('.alert'); 
    const allMoneyTamtinh = $('.control-all-money-tamtinh');
    const allMoneyTotal = $('.control-all-money-total');
    const customerPaymentInput = $('input[type="number"]'); 
    const customerDebt = $('.control-all-money'); 

    productSection.hide();

    //tim kiem sp
    $('#search-btn').click(function(event) {
        event.preventDefault(); 
        const searchTerm = $('#myInput').val().trim();
        if (searchTerm) {
            $.ajax({
                method: 'GET',
                data: { search: searchTerm },
                success: function(response) {
                    const newTableRows = $(response).find('#product-list').html();
                    productList.html(newTableRows);
                    if (newTableRows.trim() !== "") {
                        productSection.show(); 
                    } else {
                        productSection.hide();
                    }
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
        const formattedPrice = productPrice.toLocaleString('vi-VN');

        if (productRow.length) {
            const quantityInput = productRow.find('.quantity');
            let currentQuantity = parseInt(quantityInput.val());

            if (currentQuantity >= productQuantityInStock) {
                alertMessage.text(`Số lượng sản phẩm này đã đạt giới hạn trong kho!`).show();
                return;
            }
            quantityInput.val(currentQuantity + 1);
        } else {
            const newRow = `
                <tr data-id="${productId}">
                    <td>${productId}</td>
                    <td>${productName}</td>
                    <td><input type="number" class="form-control quantity" value="1" min="1" max="${productQuantityInStock}" style="width: 70px;"></td>
                    <td>${formattedPrice} VND</td>
                    <td><button class="btn btn-danger btn-sm remove-from-cart">Xóa</button></td>
                </tr>`;
            cartList.append(newRow);
        }
        updateTotalAmount();
    });

    //xoa sp trong gio
    $(document).on('click', '.remove-from-cart', function() {
        $(this).closest('tr').remove();
        updateTotalAmount();
    });

    //update tong tien
    function updateTotalAmount() {
        let total = 0;
        cartList.find('tr').each(function() {
            const price = parseFloat($(this).find('td:nth-child(4)').text().replace(/,/g, '').replace(' VND', ''));
            const quantity = parseInt($(this).find('.quantity').val());
            total += price * quantity;
        });

        allMoneyTamtinh.text(`= ${total.toLocaleString('vi-VN')} VNĐ`);
        allMoneyTotal.text(`= ${total.toLocaleString('vi-VN')} VNĐ`);
        updateCustomerDebt(total);
    }

    function updateCustomerDebt(totalAmount) {
        const paymentAmount = parseInt(customerPaymentInput.val()) || 0;
        const debt = totalAmount - paymentAmount;
        customerDebt.text(`- ${debt.toLocaleString('vi-VN')} VNĐ`);
    }
    // kiem tra so luong 
    $(document).on('input', '.quantity', function() {
        const quantityInput = $(this);
        const maxQuantity = parseInt(quantityInput.attr('max'));
        let newQuantity = parseInt(quantityInput.val());

        if (newQuantity > maxQuantity) {
            alertMessage.text(`Chỉ còn ${maxQuantity} sản phẩm trong kho.`).show();
            quantityInput.val(maxQuantity); 
        }
        updateTotalAmount();
    });

    customerPaymentInput.on('input', function() {
        const totalAmountValue = parseInt(allMoneyTotal.text().replace(/[^0-9]/g, ''));
        updateCustomerDebt(totalAmountValue);
    });
});

</script>


<!----------------------- tinh tien thua ---------------------------->
<script>
   document.getElementById('tinh_tien_thoi').addEventListener('click', function () {
    const khachDuaTienInput = document.getElementById('khachhang_dua_tien');
    const tongCongText = document.querySelector('.control-all-money-total').innerText;

    // Lấy giá trị từ giao diện
    const khachDuaTien = khachDuaTienInput.value.replace(/[^0-9]/g, '');
    const tongCong = tongCongText.replace(/[^0-9]/g, '');

    // Gửi yêu cầu Ajax đến PHP
    fetch('calculate_change.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `khachhang_dua_tien=${khachDuaTien}&tongcong=${tongCong}`
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById('tienso').innerText = `= ${data.change} VNĐ`;
        })
        .catch(error => console.error('Error:', error));
});



</script>


</body>

</html>