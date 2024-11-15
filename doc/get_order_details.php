<?php
include 'connect.php';
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 0;

if ($order_id > 0) {
    $sql = "SELECT c.MaSP, s.TenSP, c.SoLuong, c.GiaBan 
            FROM chitiethoadon c
            JOIN sanpham s ON c.MaSP = s.MaSP
            WHERE c.MaHD = $order_id";
    
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $details = [];
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        echo json_encode($details);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}

$conn->close();
?>
