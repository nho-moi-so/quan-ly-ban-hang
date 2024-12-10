<?php
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sdt = $_POST['sdt'];
        $sql_khachhang = "SELECT TenKH FROM khachhang WHERE DienThoai = '$sdt'";
        $result_khachhang = $conn->query($sql_khachhang);
        
        if ($result_khachhang && $result_khachhang->num_rows > 0) {
            $row = $result_khachhang->fetch_assoc();
            echo json_encode(['status' => 'success', 'TenKH' => $row['TenKH']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy khách hàng']);
        }
    }
    $conn->close();
?>
