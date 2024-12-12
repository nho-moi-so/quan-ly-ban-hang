<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tongTien = isset($_POST['tong_tien']) ? floatval($_POST['tong_tien']) : null;
    $maKH = isset($_POST['ma_kh']) ? intval($_POST['ma_kh']) : null; // Lấy mã khách hàng từ POST

    if ($tongTien > 0 && $maKH > 0) { 
        $conn->begin_transaction(); 
        try {
            $ngayBan = date('Y-m-d H:i:s');
            $diemTichLuy = ($tongTien / 100000) * 100;

            $sql = "INSERT INTO donhang (khach_hang, ngay_ban, tong_tien, pttt) 
                    VALUES ('$maKH', NOW(), '$tongTien', '$phuongThucThanhToan')";
            if (!$conn->query($sql)) {
                throw new Exception("Lỗi khi lưu đơn hàng: " . $conn->error);
            }
            $maDonHang = $conn->insert_id; 

            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    $maSP = $conn->real_escape_string($item['MaSP']);
                    $soLuong = intval($item['quantity'] ?? 0);
                    $giaBan = floatval($item['DonGia'] ?? 0);
                    $thanhTien = $soLuong * $giaBan;

                    if ($soLuong > 0 && $giaBan > 0) {
                        $sqlCTHD = "INSERT INTO chitiethoadon (MaHD, MaSP, SoLuong, GiaBan, ThanhTien) 
                                    VALUES ('$maDonHang', '$maSP', '$soLuong', '$giaBan', '$thanhTien')";
                        if (!$conn->query($sqlCTHD)) {
                            throw new Exception("Lỗi khi thêm chi tiết hóa đơn: " . $conn->error);
                        }
                    }
                }
            }

            $sql_get_diem = "SELECT DiemTichLuy FROM khachhang WHERE MaKH = '$maKH'";
            $result_diem = $conn->query($sql_get_diem);
            if ($result_diem && $result_diem->num_rows > 0) {
                $diemTichLuyHienTai = $result_diem->fetch_assoc()['DiemTichLuy'];
                $newDiemTichLuy = $diemTichLuyHienTai + $diemTichLuy;

                $sql_update_diem = "UPDATE khachhang 
                                    SET DiemTichLuy = $newDiemTichLuy 
                                    WHERE MaKH = '$maKH'";
                if (!$conn->query($sql_update_diem)) {
                    throw new Exception("Lỗi khi cập nhật điểm tích lũy: " . $conn->error);
                }
            }

            $conn->commit(); 
            echo json_encode(['success' => true, 'message' => 'Đơn hàng đã được lưu thành công', 'maDonHang' => $maDonHang]);
        } catch (Exception $e) {
            $conn->rollback(); 
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Tổng tiền hoặc mã khách hàng không hợp lệ']);
    }
}

$conn->close();
?>
