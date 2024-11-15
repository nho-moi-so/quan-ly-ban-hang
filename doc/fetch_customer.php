<?php
include 'connect.php';

if (isset($_GET['sdt'])) {
    $sdt = $_GET['sdt'];

    $stmt = $conn->prepare("SELECT ho_ten FROM khachhang WHERE sdt = ?");
    $stmt->bind_param("s", $sdt);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $khachhang = $result->fetch_assoc();
        echo json_encode(['success' => true, 'data' => $khachhang]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy khách hàng.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Thiếu tham số SĐT.']);
}

$conn->close();
?>
