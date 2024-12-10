<?php
include 'connect.php';

$response = array('success' => false, 'error' => '');

                    $tamtinh = 0;
                        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                            foreach ($_SESSION['cart'] as $item) {
                                $soLuong = isset($item['quantity']) ? $item['quantity'] : 0;
                                $donGia = isset($item['DonGia']) ? $item['DonGia'] : 0;
                                $tamtinh += $soLuong * $donGia;
                            }
                        }
                    $tongcong = $tamtinh;
                    // tien thua
                    $soTienNhan = intval($_POST['khachhang_dua_tien']); 
                    $tongTien = intval($tongcong);
                    $soTienThua = $soTienNhan - $tongTien; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maKH = isset($_POST['khach_hang']) ? $_POST['khach_hang'] : null;
    $maNV = isset($_POST['ma_nv']) ? $_POST['ma_nv'] : null;
    $tongTien = isset($_POST['tong_tien']) ? $_POST['tong_tien'] : 0;
    $ngayBan = date('Y-m-d H:i:s');
    $phuongThucThanhToan = isset($_POST['hinhthucthanhtoan']) ? $_POST['hinhthucthanhtoan'] : null;
    $khachhang_dua_tien = isset($_POST['khachhang_dua_tien']) ? $_POST['khachhang_dua_tien'] : 0;
    
//them vao bang don hang
    $sql = "INSERT INTO donhang (khach_hang, ngay_ban, tong_tien, ma_nv) 
            VALUES ('$maKH', NOW() , '$tongTien', '$maNV')";
    if ($conn->query($sql) === TRUE) {

        $maDonHang = $conn->insert_id;
        $ngayHienTai = date('Ymd');
        $soThuTu = str_pad($maDonHang, 3, '0', STR_PAD_LEFT);
        $maDonHangFormatted = "DH-" . $ngayHienTai . "-" . $soThuTu;

        $sqlUpdate = "UPDATE donhang SET ma_don_hang = '$maDonHangFormatted' WHERE id_don_hang = $maDonHang";
        $conn->query($sqlUpdate);

//luu chi tiet don hang
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as $item) {
                $maSP = $conn->real_escape_string($item['MaSP']);
                $soLuong = isset($item['quantity']) ? $item['quantity'] : 0;
                $giaBan = isset($item['DonGia']) ? $item['DonGia'] : 0;
                
                $sqlCTHD = "INSERT INTO chitiethoadon (MaHD, MaSP, SoLuong, GiaBan) 
                            VALUES ('$maDonHang', '$maSP', '$soLuong', '$giaBan')";
                $conn->query($sqlCTHD);
            }
        }

//luu thong tin chuyen khoan
        if ($phuongThucThanhToan == "Chuyển khoản") {
            $soTaiKhoan = $_POST['so_tai_khoan'];
            $tenTaiKhoan = $_POST['ten_tai_khoan'];
            $tenNganHang = $_POST['ten_ngan_hang'];
            $ngayChuyenKhoan = $_POST['ngay_chuyen_khoan'];
            $soTienChuyenKhoan = $_POST['so_tien_chuyen_khoan'];
        
            $sqlChuyenKhoan = "INSERT INTO chuyenkhoan (MaKH, SoTaiKhoan, tenTK, tenNH, NgayChuyenKhoan, SoTienChuyenKhoan) 
                               VALUES ('$maKH', '$soTaiKhoan', '$tenTaiKhoan', '$tenNganHang', '$ngayChuyenKhoan', '$soTienChuyenKhoan')";
            $conn->query($sqlChuyenKhoan);
        }
//luu thong tin tien mat
        if ($phuongThucThanhToan == "Tiền mặt") {
            $soTienNhan = $_POST['khachhang_dua_tien']; 
            $soTienThua = $soTienNhan - $tongTien;
        
            $sqlTienMat = "INSERT INTO thongtintienmat (SotienNhan, SoTienThua, MaKH) 
                           VALUES ('$soTienNhan', '$soTienThua', '$maKH')";
            $conn->query($sqlTienMat);
        }
        
//diem tich luy
        $diemTichLuy = $tongTien * 0.01;
        $sql_get_diem = "SELECT DiemTichLuy FROM khachhang WHERE MaKH = '$maKH'";
        $result_diem = $conn->query($sql_get_diem);
        $diemTichLuyHienTai = ($result_diem && $result_diem->num_rows > 0) ? $result_diem->fetch_assoc()['DiemTichLuy'] : 0;
        $newDiemTichLuy = $diemTichLuyHienTai + $diemTichLuy;

        $sql_update_diem = "UPDATE khachhang 
                            SET DiemTichLuy = $newDiemTichLuy 
                            WHERE MaKH = '$maKH'";
        $conn->query($sql_update_diem);


        $response['success'] = true;
    } else {
        $response['error'] = $conn->error;
    }

    $conn->close();
}
?>
