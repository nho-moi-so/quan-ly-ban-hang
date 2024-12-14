<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ POST
    $maKH = isset($_POST['ma_kh']) ? intval($_POST['ma_kh']) : null;
    $tongTien = isset($_POST['tong_tien']) ? floatval($_POST['tong_tien']) : null;
    $cartItems = $_POST['cart_items'] ?? [];
    $phuongThucThanhToan = $_POST['phuong_thuc_thanh_toan'] ?? null;

    // Kiểm tra dữ liệu hợp lệ
    if ($tongTien <= 0 || empty($maKH) || empty($phuongThucThanhToan) || empty($cartItems)) {
        echo json_encode(['success' => false, 'error' => 'Đơn hàng không hợp lệ']);
        exit;
    }

    $conn->begin_transaction();
    try {
        // Tạo đơn hàng
        $ngayBan = date('Y-m-d H:i:s');
        $diemTichLuy = ($tongTien / 100000) * 100;

        $sqlDonHang = "INSERT INTO donhang (khach_hang, ngay_ban, tong_tien, pttt) 
                        VALUES (?, ?, ?, ?)";
        $stmtDonHang = $conn->prepare($sqlDonHang);
        $stmtDonHang->bind_param('isds', $maKH, $ngayBan, $tongTien, $phuongThucThanhToan);
        if (!$stmtDonHang->execute()) {
            throw new Exception("Lỗi khi lưu đơn hàng: " . $stmtDonHang->error);
        }
        $maDonHang = $stmtDonHang->insert_id;

        // Thêm chi tiết hóa đơn
        if (!empty($cartItems)) {
            $sqlChiTiet = "INSERT INTO chitiethoadon (MaHD, MaSP, SoLuong, GiaBan, ThanhTien) 
                            VALUES (?, ?, ?, ?, ?)";
            $stmtChiTiet = $conn->prepare($sqlChiTiet);
            $cartItemsArray = json_decode($cartItems, true);

            foreach ($cartItemsArray as $item) {
                $maSP = intval($item['id']);
                $soLuong = intval($item['quantity']);
                $giaBan = intval($item['price']);
                $thanhTien = $soLuong * $giaBan;

                if ($soLuong > 0 && $giaBan > 0) {
                    $stmtChiTiet->bind_param('iiidd', $maDonHang, $maSP, $soLuong, $giaBan, $thanhTien);
                    if (!$stmtChiTiet->execute()) {
                        throw new Exception("Lỗi khi thêm chi tiết hóa đơn: " . $stmtChiTiet->error);
                    }
                }
            }
        }

        // Cập nhật điểm tích lũy khách hàng
        $sqlDiemTichLuy = "UPDATE khachhang SET DiemTichLuy = DiemTichLuy + ? WHERE MaKH = ?";
        $stmtDiemTichLuy = $conn->prepare($sqlDiemTichLuy);
        $stmtDiemTichLuy->bind_param('di', $diemTichLuy, $maKH);
        if (!$stmtDiemTichLuy->execute()) {
            throw new Exception("Lỗi khi cập nhật điểm tích lũy: " . $stmtDiemTichLuy->error);
        }

        $sqlTienMat = "INSERT INTO thongtintienmat (SotienNhan, SoTienThua, MaKH, MaHD) 
                        VALUES (?, ?, ?, ?)";
        $stmtTienMat = $conn->prepare($sqlTienMat);
        $sqlChuyenKhoan = "INSERT INTO chuyenkhoan (MaKH, MaHD, SoTaiKhoan, tenTK, tenNH, NgayChuyenKhoan, SoTienChuyenKhoan) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtChuyenKhoan = $conn->prepare($sqlChuyenKhoan);

        // Luu thong tin chuyen khoan or tien mat
        if ($phuongThucThanhToan == "Tiền mặt") {
            $tienNhan = isset($_POST['tien_nhan']) ? floatval($_POST['tien_nhan']) : 0;
            $tienThua = isset($_POST['tien_thua']) ? floatval($_POST['tien_thua']) : 0;

            if (!empty($tienNhan) && !empty($tienThua)) {
                $stmtTienMat->bind_param('ddii', $tienNhan, $tienThua, $maKH, $maDonHang);

                if (!$stmtTienMat->execute()) {
                    throw new Exception("Lỗi khi lưu thông tin tiền mặt: " . $stmtTienMat->error);
                }
            } else {
                throw new Exception("Không nhận được tiền!");
            }
        } else if ($phuongThucThanhToan = "Chuyển khoản") {
            $soTaiKhoan = isset($_POST['so_tai_khoan']) ? $_POST['so_tai_khoan'] : '';
            $tenTK = isset($_POST['ten_tai_khoan']) ? $_POST['ten_tai_khoan'] : '';
            $tenNH = isset($_POST['ten_ngan_hang']) ? $_POST['ten_ngan_hang'] : '';
            $ngayChuyenKhoan = isset($_POST['ngay_chuyen_khoan']) ? $_POST['ngay_chuyen_khoan'] : '';
            $soTienChuyenKhoan = isset($_POST['so_tien_chuyen_khoan']) ? floatval($_POST['so_tien_chuyen_khoan']) : 0;

            if (!empty($soTaiKhoan) && !empty($tenTK) && !empty($tenNH) && !empty($ngayChuyenKhoan) && !empty($soTienChuyenKhoan)) {
                $stmtChuyenKhoan->bind_param('iissssd', $maKH, $maDonHang, $soTaiKhoan, $tenTK, $tenNH, $ngayChuyenKhoan, $soTienChuyenKhoan);

                if (!$stmtChuyenKhoan->execute()) {
                    throw new Exception("Lỗi khi lưu thông tin chuyển khoản: " . $stmtChuyenKhoan->error);
                }
            } else {
                throw new Exception("Không đủ thông tin chuyển khoản!");
            }
        }

        // Hoàn tất giao dịch
        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'Đơn hàng đã được lưu thành công', 'maDonHang' => $maDonHang]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

$conn->close();
