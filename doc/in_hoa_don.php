<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $idDonHang = $_GET['id'];
    $sql_donhang = "SELECT * FROM donhang WHERE id_don_hang = '$idDonHang'";
    $result_donhang = $conn->query($sql_donhang);
    $donhang = $result_donhang->fetch_assoc();
    $sql_chitiet = "SELECT * FROM chitietdonhang WHERE id_don_hang = '$idDonHang'";
    $result_chitiet = $conn->query($sql_chitiet);
    
    echo "<h1>Hóa đơn</h1>";
    echo "<p>Mã đơn hàng: " . $donhang['ma_don_hang'] . "</p>";
    echo "<p>Khách hàng: " . $donhang['khach_hang'] . "</p>";
    echo "<p>Ngày bán: " . $donhang['ngay_ban'] . "</p>";
    echo "<p>Tổng tiền: " . number_format($donhang['tong_tien'], 0, ',', '.') . " VNĐ</p>";
    echo "<h2>Chi tiết đơn hàng:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Mã sản phẩm</th><th>Số lượng</th><th>Đơn giá</th><th>Thành tiền</th></tr>";

    while ($chitiet = $result_chitiet->fetch_assoc()) {
        $thanhTien = $chitiet['SoLuong'] * $chitiet['DonGia'];
        echo "<tr><td>" . $chitiet['MaSP'] . "</td><td>" . $chitiet['SoLuong'] . "</td><td>" . number_format($chitiet['DonGia'], 0, ',', '.') . "</td><td>" . number_format($thanhTien, 0, ',', '.') . "</td></tr>";
    }
    echo "</table>";
}
?>
