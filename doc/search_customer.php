<?php
include 'connect.php';

$response = ['status' => 'error', 'message' => 'Không tìm thấy khách hàng'];

if (isset($_POST['sdt'])) {
    $sdt = $conn->real_escape_string($_POST['sdt']);
    $sql_khachhang = "SELECT TenKH FROM khachhang WHERE DienThoai = '$sdt'";
    $result_khachhang = $conn->query($sql_khachhang);

    if ($result_khachhang && $result_khachhang->num_rows > 0) {
        $khachhang = $result_khachhang->fetch_assoc();
        $response = [
            'status' => 'success',
            'TenKH' => $khachhang['TenKH'],
        ];
    }
}

echo json_encode($response);
$conn->close();
?>
