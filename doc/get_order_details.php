<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;

    if ($orderId > 0) {
        $sql = "SELECT chitiethoadon.MaSP, sanpham.TenSP, chitiethoadon.SoLuong, chitiethoadon.GiaBan 
                FROM chitiethoadon
                JOIN sanpham ON chitiethoadon.MaSP = sanpham.MaSP
                WHERE chitiethoadon.MaHD = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
        $result = $stmt->get_result();

        $orderDetails = [];
        while ($row = $result->fetch_assoc()) {
            $orderDetails[] = $row;
        }

        echo json_encode($orderDetails);
    } else {
        echo json_encode(['error' => 'Invalid order ID']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

$conn->close();
?>
