<?php
include "connect.php";

// Nhận dữ liệu từ form
$maKH = $_POST['maKH'];
$hoten = $_POST['hoten'];
$sdt = $_POST['sdt'];

echo var_dump($_POST);

// Kiểm tra dữ liệu
if (!empty($maKH) && !empty($hoten) && !empty($sdt)) {
    // Thực hiện cập nhật
    $query = "UPDATE khachhang SET TenKH = ?, DienThoai = ? WHERE MaKH = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $hoten, $sdt, $maKH);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thông tin khách hàng thành công!'); window.location.href = 'table-data-khachhang.php';</script>";
    } else {
        echo "<script>alert('Lỗi: " . $conn->error . "');</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('Dữ liệu không hợp lệ!');</script>";
}
$conn->close();
?>
