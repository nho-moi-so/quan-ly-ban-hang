<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sdt = isset($_POST['sdt']) ? $_POST['sdt'] : '';

    if ($sdt) {
        $stmt = $conn->prepare("SELECT MaKH, TenKH FROM khachhang WHERE DienThoai = ?");
        $stmt->bind_param("s", $sdt);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $khachhang = $result->fetch_assoc();
            echo json_encode(['status' => 'success', 'MaKH' => $khachhang['MaKH'], 'TenKH' => $khachhang['TenKH']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy khách hàng']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Số điện thoại không hợp lệ']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ']);
}

$conn->close();
?>
